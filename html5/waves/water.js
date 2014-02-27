(function($)
{

  var canvas;
  var ctx;
  var img;
  var frame_width=800;
  var frame_height=535;
  var img_data;
  var data;
  var img_data32;
  var buffer;
  var buffer32;
  var start_ms;
  var last_time=0;
  var last_time_delta;
  var fps=30;
  var period = 2040; //one second period, made (as a multiple of fps) so FPS divides evenly to prevent frame skips
  var frame_count = period/fps;
  var animate;
  var startY=330;
  var height;
  var width;
  var $log;
  var frame_buffer=[];
  var current_frame=0;
  
  
  function init(callback)
  {
    canvas = $("#water")[0];
    $log = $("#log");
    ctx = canvas.getContext('2d');
    img = new Image();
    start_ms = Date.now();
  
    img.src = "ocean.jpg";
    //img.src = "grid.png";
    img.onload = function()
    {
      ctx.drawImage(img,0,0,frame_width,frame_height);
      img_data = ctx.getImageData(0,0,frame_width,frame_height);
      data = img_data.data;
      buffer = ctx.getImageData(0,0,frame_width,frame_height);
      height = img_data.height;

      //using 32bit writes ended up being slower for some reason, so this section is commented out 
      //until I can understand why
      //
      /*if(typeof Uint8ClampedArray === "undefined")
      {
        //IE 9, and other non-ArrayBuffer supporting browsers
        width = img_data.width*4;
        animate = animate_non_array_buffer;
      }
      else
      {
        buffer32=new Uint32Array(buffer.data.buffer);
        img_data32 = new Uint32Array(data.buffer);

        //detect endian-ness of the cpu
        var b = new ArrayBuffer(4);
        var d = new Uint32Array(b);
        d[0]=0x0a0b0c0d;
        var big_endian=true;
        if(b[0]==0x0d) big_endian=false;

        width = img_data.width;
        if(big_endian)
        {
          animate = animate_array_buffer_big_endian;
        }
        else
        {
          animate = animate_array_buffer_little_endian;
        }
      }*/

      width = img_data.width*4;
      init_framebuffer();
      //animate = animate_framebuffer; //use the precalculated framebuffer strategy
      requestInterval(animate_framebuffer, 1000/fps);
      //animate = animate_non_array_buffer; //the the non-WebGL ArrayBuffer procedural strategy

      
      //buffer = ctx.createImageData(img_data);
      //callback();
      //ctx.drawImage(img,0,0,800,535);
    };
  }

  /*function animate_array_buffer_big_endian()
  {
    var i=0,j=0;
    var current_time = Date.now();
    var time_delta = current_time - last_time;
    last_time = current_time;
    var time = (time_delta * .9) + (last_time_delta * .1);
    last_time_delta = time_delta;
    var fps = 1000/time;
    var total_time = current_time - start_ms;
    var i_offset=0;
    var dist;
    var i_delta;
    var n;
    //local references to speed lookups
    var floor=Math.floor;
    var sin=Math.sin;
    var sqrt = Math.sqrt;
    var buffer_data = buffer32; 
    var im_data = img_data32; 
    var w=width;
    var h=height;
    var sy = startY;
    var p=period;
    
    //buffer = ctx.createImageData(img_data);

    $log.html(" fps:" + fps);


    for(i=sy;i<h;i++)
    {
      for(j=0;j<w;j++)
      {
        i_delta = i * w + j;
        
        dist = sqrt(i - sy);
        //i_offset = i - Math.floor(Math.sin(total_time/period - Math.sqrt(dist)) * Math.sqrt(dist)/2);
        n = i - sin(total_time/p - dist) * dist/2;
        i_offset = n | n; //truncate without Math.floor
        i_offset = i_offset * w + j;
        buffer_data[i_delta]=im_data[i_offset];
      }
    }
    //ctx.putImageData(buffer,0,startY,0,startY,800,200);
    ctx.putImageData(buffer,0,0);
    
    requestAnimFrame(
      function()
      {
        animate();
      });
  }*/

  function animate_array_buffer_little_endian()
  {
  }

  function init_framebuffer()
  {
    var i=0,j=0;
    var current_time = Date.now();
    var time_delta = current_time - last_time;
    last_time = current_time;
    var time = (time_delta * .9) + (last_time_delta * .1);
    last_time_delta = time_delta;
    var calculated_fps = 1000/time;
    var total_time = current_time - start_ms;
    var i_offset=0;
    var dist;
    var i_delta;
    var n;
    //local references to speed lookups
    var floor=Math.floor;
    var sin=Math.sin;
    var sqrt = Math.sqrt;
    var buffer_data = buffer.data;
    var w=width;
    var h=height;
    var sy = startY;
    var p=period;
    var img_data = data;
    var fb = frame_buffer;
    var frame_index=0;
    var current_frame=0;
    
    //buffer = ctx.createImageData(img_data);

    $log.html(" fps:" + calculated_fps);

    //create frame buffer blank data
    for(frame_index=0;frame_index<frame_count;frame_index++)
      fb[frame_index] = ctx.getImageData(0,0,frame_width,frame_height);


    //create the animation frames
    for(frame_index=0;frame_index<frame_count;frame_index++)
    {
      for(i=sy;i<h;i++)
      {
        for(j=0;j<w;j+=4)
        {
          i_delta = i * w + j;
          
          dist = sqrt(i - sy);
          //i_offset = i - Math.floor(Math.sin(total_time/period - Math.sqrt(dist)) * Math.sqrt(dist)/2);
          n = i - sin(((2*Math.PI)/frame_count) * frame_index - dist) * dist/3;
          i_offset = n | n; //truncate without Math.floor
          i_offset = i_offset * w + j;
          frame_buffer[frame_index].data[i_delta]=img_data[i_offset];
          frame_buffer[frame_index].data[i_delta + 1]=img_data[i_offset + 1];
          frame_buffer[frame_index].data[i_delta + 2]=img_data[i_offset + 2];
          frame_buffer[frame_index].data[i_delta + 3]=img_data[i_offset + 3];
          
        }
      }
    }
  }

  function animate_framebuffer()
  {
    ctx.putImageData(frame_buffer[current_frame],0,0);
    current_frame++;
    if(current_frame >= frame_count) current_frame=0;

    
  }

  function animate_non_array_buffer()
  {
    var i=0,j=0;
    var current_time = Date.now();
    var time_delta = current_time - last_time;
    last_time = current_time;
    var time = (time_delta * .9) + (last_time_delta * .1);
    last_time_delta = time_delta;
    var fps = 1000/time;
    var total_time = current_time - start_ms;
    var i_offset=0;
    var dist;
    var i_delta;
    var n;
    //local references to speed lookups
    var floor=Math.floor;
    var sin=Math.sin;
    var sqrt = Math.sqrt;
    var buffer_data = buffer.data;
    var w=width;
    var h=height;
    var sy = startY;
    var p=period;
    var img_data = data;
    
    //buffer = ctx.createImageData(img_data);

    $log.html(" fps:" + fps);


    for(i=sy;i<h;i++)
    {
      for(j=0;j<w;j+=4)
      {
        i_delta = i * w + j;
        
        dist = sqrt(i - sy);
        //i_offset = i - Math.floor(Math.sin(total_time/period - Math.sqrt(dist)) * Math.sqrt(dist)/2);
        n = i - sin(total_time/p - dist) * dist/2;
        i_offset = n | n; //truncate without Math.floor
        i_offset = i_offset * w + j;
        buffer_data[i_delta]=img_data[i_offset];
        buffer_data[i_delta + 1]=img_data[i_offset + 1];
        buffer_data[i_delta + 2]=img_data[i_offset + 2];
        buffer_data[i_delta + 3]=img_data[i_offset + 3];
        
      }
    }
    //ctx.putImageData(buffer,0,startY,0,startY,800,200);
    ctx.putImageData(buffer,0,0);
    
    requestAnimFrame(
      function()
      {
        animate();
      });
  }

  $(document).ready(
    function()
    {
      /*init(
        function()
        {
          animate();
        }
      );*/
      init();

    });

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

})(jQuery)
