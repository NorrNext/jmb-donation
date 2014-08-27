/**
 * @package    Jmb_donation
 * @author     Lex, AllDar
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

var Smile = new Class({
	initialize: function(el, val, scale, linewidth, linecolor){
		this.scale = scale;
		this.linewidth = linewidth;
		this.linecolor = linecolor;
		this.criteCanvasTag(el, val);
	},

	canvassupport: function(el) {
		if (el.get('tag')!='canvas') {
			return false;
		} else {
			if (Browser.ie) el = G_vmlCanvasManager.initElement(el);
			if (el.getContext){
				return true;
			} else {
				return false;
			}
		}
	},

	criteCanvasTag:function(canvas, val){
		if (this.canvassupport(canvas)){
			this.SmileDraw(canvas, val);
		}else{
			canvas.set('html','Canvas not supported');
		}
	},

	SmileDraw: function(el, val){
		var ctx = el.getContext('2d');
		var prop = 25;
		var scale = this.scale;
		var linewidth = this.linewidth;
		var linecolor = this.linecolor;
		ctx.clearRect(0, 0, el.width, el.height);
		ctx.beginPath();	    
		ctx.moveTo(prop*3*scale,prop*3*scale);
		ctx.lineTo(prop*3.2*scale,prop*3.2*scale+val/10*scale);
		ctx.lineTo(prop*2.8*scale,prop*3.2*scale+val/10*scale);
		ctx.lineTo(prop*3*scale,prop*3*scale);
		ctx.moveTo(prop*5*scale,prop*3*scale);
		ctx.arc(prop*3*scale,prop*3*scale,prop*2*scale,0,Math.PI*2,true); 
		ctx.moveTo(prop*4.4*scale,prop*4*scale-val/5*scale);
		ctx.bezierCurveTo (prop*4*scale,val/2*scale+prop*3.2*scale,prop*2*scale,val/2*scale+prop*3.2*scale,prop*1.6*scale,prop*4*scale-val/5*scale);
		ctx.moveTo(prop*2.6*scale,prop*2.6*scale);
		ctx.arc(prop*2.4*scale,prop*2.6*scale,val/10*scale,0,Math.PI*2,false);
		ctx.moveTo(prop*3.8*scale,prop*2.6*scale);
		ctx.arc(prop*3.6*scale,prop*2.6*scale,val/10*scale,0,Math.PI*2,false);
		ctx.lineWidth =  linewidth;
		ctx.strokeStyle = linecolor;
		ctx.stroke();
	}
});
