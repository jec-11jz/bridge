
if(jQuery) jQuery.fn.extend({
	ajaxForm	: function($_){
		var $opt = {};
		if( typeof $_ === 'function' ) $opt.success = $_;
		if( typeof $_ === 'object'   ) $opt = $.extend($opt,$_);
		return $(this).submit(function(event){
			event.preventDefault();
			return jQuery.ajax($.extend({
				url			: jQuery(this).attr('action'),
				type		: jQuery(this).attr('method'),
				data		: jQuery(this).serialize(),
				dataType	: jQuery(this).attr('data-type') || 'json',
			},$opt) );
		});
	}
});
