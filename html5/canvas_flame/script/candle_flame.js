/**
 * Small utility to create simulated candle flame with flicker and lighting
 * Nothing fancy here, just a basic utility, limited options
 *
 * Requires jquery
 *
 * Example use:
 *
 * candle_flame(
 *  {
 *    height: 10,
 *    width: 5,
 *    x: 100,
 *    y: 100
 *  });
 *
 * Author: Clayton Gulick clay@ratiosoftware.com
 */
function candle_flame(options)
{
  var $canvas, //the canvas that hosts the animation
      $container, //the container to add the canvas to (jquery instance)
      ctx,    //the 2d context
      data,    //the image data
      settings, //the settings to use for the candle flame
      height, //cache frequently used variables from settings to save dict lookup
      width
      ;      
  var defaults = {
      height:100, //the height of the canvas
      width:50,  //the width of the canvas
      x:375,      //the x position
      y:300,      //the y position
      container: $("body")[0], //the container element to add the flame to
      flame_size:15, //the radius of the circle used to draw the base flame particle
      fade_rate: 15,
      inner_color: 'rgba(255,255,255,1)', //the color of the innermost part of the flame
      mid_color: 'rgba(180,130,50,.8)', //the color of the mid_region of the flame
      outer_color: 'rgba(100,40,20,.3)' //the color of the outer part of the flame
      };
  var settings = $.extend(defaults,options);
  //this is a handle to the requestAnimation shim, used for stopping animation
  var anim_handle;
  $container = $(settings.container);

  height = settings.height;
  width = settings.width;
  x = settings.x;
  y = settings.y;
  $canvas = $("<canvas width='" + width + "' height='" + height + "'></canvas>");
  $container.append($canvas);
  $canvas.css(
    {
      position: "absolute",
      top: y,
      left: x
    });
  ctx = $canvas[0].getContext('2d');

  anim_handle = requestInterval(draw,33);
  //drawFlame();
  //

  //this is returned as a token that can be used to remove the candle animation
  var destroy = function()
  {
    clearRequestInterval(anim_handle);
    $canvas.remove();
  }
  
  /**
   * Shift pixels up
   * This uses some tricks to avoid pixel by pixel processing
   */
  function shift()
  {
    var image_data = ctx.getImageData(0,1,width,height);
    fade(image_data);
    ctx.clearRect(0,0,width,height);
    ctx.putImageData(image_data,0,0,0,0,width,height);
  }
  
  /**
   * Fade all pixels by decreasing their alpha value
   * Is there a faster way to do this with compositing?
   */
  function fade(image_data)
  {
    var data = image_data.data;
    var i=0;
    for(i=0; i<data.length; i+=4)
    {
      data[i + 3] = data[i + 3]-settings.fade_rate;
    }
    
  }

  var top_x_dir; //the direction the x is moving
  var top_x_pos = width/2;
  var top_x_velocity;
  var bottom_x_dir;
  var bottom_x_pos = width/2;
  var bottom_x_velocity;
  var flame_dir;
  var flame_size = settings.flame_size;
  var flame_delta;
  /**
   * This handles rendering of the actual flame particle at the bottom, which gets shifted up and faded out over time
   * to create flame effect.
   *
   * X position and size of the drawn particle varies randomly to create flicker
   */
  function drawFlame()
  {
    var gradient; //the radial gradient to use for rendering
    top_x_velocity = width/15 *Math.random();
    top_x_dir = Math.random * 2 > 1 ? 1 : -1;
    bottom_x_velocity = width/20*Math.random();
    bottom_x_dir = Math.random() * 2 > 1 ? 1 : -1;
    flame_delta = Math.random() * 2;
    flame_dir = Math.random() * 2 > 1 ? 1 : -1;
    flame_size += flame_delta * flame_dir;
    if(flame_size > settings.flame_size) flame_size = settings.flame_size;
    if(flame_size < settings.flame_size/3) flame_size = settings.flame_size/3;

    gradient = ctx.createRadialGradient(bottom_x_pos + (bottom_x_velocity * bottom_x_dir), //x
                                        (height - flame_size/1.1) / 2, //y - divide by the scale factor for elliptical transform
                                        1, //radius
                                        top_x_pos + (top_x_velocity * top_x_dir),
                                        (height - (Math.random() * height/10))/2, //outer y - divide by scale factor
                                        flame_size); //radius
    gradient.addColorStop(0,settings.inner_color);
    gradient.addColorStop(.2,settings.inner_color);
    gradient.addColorStop(.6,settings.mid_color);
    gradient.addColorStop(.7,settings.outer_color);
    gradient.addColorStop(1,'rgba(255,255,255,0)');

    ctx.fillStyle=gradient;
    ctx.setTransform(1,0,0,2,0,0);
    ctx.fillRect(0,0,width,height);
  }

  /**
   * This draws a semi transparent glow to give the effect of the candle flame lighting the surrounding area
   */
  function drawGlow()
  {
  }

  /**
   * Main render loop
   */
  function draw()
  {
    shift();
    drawFlame();
    drawGlow();
  }

  return destroy; //return a function that can be used to destroy the flame
  
}

if(!window.requestInterval)
{

  // HTML5 requestAnimationFrame shim //

  /**
  * Behaves the same as setInterval except uses requestAnimationFrame() where possible for better performance
  * @param {function} fn The callback function
  * @param {int} delay The delay in milliseconds
  */
  window.requestInterval = function(fn, delay) {
    if( !window.requestAnimationFrame &&
      !window.webkitRequestAnimationFrame &&
      !(window.mozRequestAnimationFrame && window.mozCancelRequestAnimationFrame) && // Firefox 5 ships without cancel support
      !window.oRequestAnimationFrame &&
    !window.msRequestAnimationFrame)
    return window.setInterval(fn, delay);

    var start = new Date().getTime(),
    handle = new Object();

    function loop() {
      var current = new Date().getTime(),
      delta = current - start;

      if(delta >= delay) {
        fn.call();
        start = new Date().getTime();
      }

      handle.value = requestAnimFrame(loop);
    };

    handle.value = requestAnimFrame(loop);
    return handle;
  }

/**
* Behaves the same as clearInterval except uses cancelRequestAnimationFrame() where possible for better performance
* @param {int|object} fn The callback function
*/
    window.clearRequestInterval = function(handle) {
      window.cancelAnimationFrame ? window.cancelAnimationFrame(handle.value) :
      window.webkitCancelAnimationFrame ? window.webkitCancelAnimationFrame(handle.value) :
      window.webkitCancelRequestAnimationFrame ? window.webkitCancelRequestAnimationFrame(handle.value) : /* Support for legacy API */
      window.mozCancelRequestAnimationFrame ? window.mozCancelRequestAnimationFrame(handle.value) :
      window.oCancelRequestAnimationFrame	? window.oCancelRequestAnimationFrame(handle.value) :
      window.msCancelRequestAnimationFrame ? window.msCancelRequestAnimationFrame(handle.value) :
      clearInterval(handle);
    };


  window.requestAnimFrame = (function(callback) {
        return window.requestAnimationFrame || 
        window.webkitRequestAnimationFrame || 
        window.mozRequestAnimationFrame || 
        window.oRequestAnimationFrame || 
        window.msRequestAnimationFrame ||
        function(callback) {
          window.setTimeout(callback, 1000 / 60);
        };
      })();


}
