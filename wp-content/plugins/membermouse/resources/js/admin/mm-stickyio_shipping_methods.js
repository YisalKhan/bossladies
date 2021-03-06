/*!
 * 
 * MemberMouse(TM) (http://www.membermouse.com)
 * (c) MemberMouse, LLC. All rights reserved.
 */
var MM_StickyioShippingMethodsViewJS = MM_Core.extend({
  
	processForm: function()
	{   
		if(jQuery("#stickyio_shipping_method_id_selector").is(":visible"))
		{
			jQuery("#stickyio_shipping_method_id").attr('value', jQuery("#stickyio_shipping_method_id_selector").val());
			jQuery("#stickyio_shipping_method_name").attr('value', jQuery("#stickyio_shipping_method_id_selector :selected").text());
		}
	},
	
	validateForm: function()
	{   
		if(jQuery("#stickyio_shipping_method_id").val() == 0 || jQuery("#stickyio_shipping_method_id").val() == "")
		{
			alert("Please select a Sticky.oi shipping method");
			return false;
		}
		
		return true;
	},
	
	getStickyioShippingDescription: function(shippingId) {
		var values = {};
		values.mm_action = "getLLShippingDescription";
		mmjs.processForm();
		if(shippingId != "")
		{
			values.shipping_id = shippingId;
		}
		else
		{
			values.shipping_id = jQuery("#stickyio_shipping_method_id").val();
		}
		
		var module = this.module;
	    var method = "performAction";
	    var action = 'module-handle';
	    
	    var ajax = new MM_Ajax(false, module, action, method);
	    ajax.send(values, false, 'mmjs','llShippingDescriptionHandler');	
	},
	
	llShippingDescriptionHandler: function(data)
	{	
		alert(data.message);
	}
});

var lastShippingMethodId = "";
var mmjs = new MM_StickyioShippingMethodsViewJS("MM_StickyioShippingMethodsView", "Shipping Method Mapping");