(function( $ ){

  $.fn.autopollock = function( options ) {  

    var settings = {
        frequency: 300
    };

    return this.each(function() {        
      if ( options ) { 
        $.extend( settings, options );
      }

      if(!this.getContext) 
      {
        alert("Invalid element selected, please ensure you select a canvas element");
        return;
      }
      var context = this.getContext("2d");
      if(!context)
      {
        alert("Unable to get context");
        return;
      }

      currentX=context.canvas.width * Math.random();
      currentY=context.canvas.height * Math.random();
      var $self = $(this);
      $self.hue=0;

      setInterval(function()
          {
            flingPaint($self,context);
          }, settings.frequency);

    });

    var currentX;
    var currentY;
    var hue=0;

    function flingPaint($canvas, context)
    {
        $canvas.hue = $canvas.hue + 10 * Math.random();
        drawSplotch($canvas, context, hue);
        context.beginPath();
        context.lineWidth = 2 + Math.random() * 10;
        context.moveTo(currentX, currentY);
        currentX=context.canvas.width * Math.random();
        currentY=context.canvas.height * Math.random();
        context.bezierCurveTo(
                context.canvas.width * Math.random(),
                context.canvas.height * Math.random(),
                context.canvas.width * Math.random(),
                context.canvas.height * Math.random(),
                currentX,
                currentY);
        context.strokeStyle = 'hsl(' + $canvas.hue + ', 50%, 50%)';
        //context.shadowColor='white';
        //context.shadowBlur=5;
        context.stroke();
        drawSplotch($canvas, context, hue);

    }

    function drawSplotch($canvas, context, hue)
    {
        var tempX;
        var tempY;
        context.beginPath();
        context.moveTo(currentX, currentY);
        tempX=currentX - (20 * Math.random());
        tempY=currentY - (20 * Math.random());
        context.bezierCurveTo(tempX - 20 * Math.random(),
                            tempY - 20 * Math.random(),
                            tempX + 20 * Math.random(),
                            tempY + 20 * Math.random(),
                            tempX,tempY);
        tempX=tempX + (20 * Math.random());
        tempY=tempY + (20 * Math.random());
        context.bezierCurveTo(tempX - 20 * Math.random(),
                            tempY - 20 * Math.random(),
                            tempX + 20 * Math.random(),
                            tempY + 20 * Math.random(),
                            tempX,tempY);
        context.bezierCurveTo(tempX - 20 * Math.random(),
                            tempY - 20 * Math.random(),
                            tempX + 20 * Math.random(),
                            tempY + 20 * Math.random(),
                            currentX,currentY);
        context.closePath();
        context.fillStyle = 'hsl(' + $canvas.hue + ', 50%, 50%)';
        context.stroke();
        context.fill();
    }

  };
})( jQuery );
