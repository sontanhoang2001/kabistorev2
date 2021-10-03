/*!
 * jQuery lightweight Fly to
 * Author: @ElmahdiMahmoud
 * Licensed under the MIT license
 */

// self-invoking
; (function ($, window, document, undefined) {
    $.fn.flyto = function (options) {

        // Establish default settings

        var settings = $.extend({
            item: '.flyto-item',
            target: '.flyto-target',
            button: '.flyto-btn',
            shake: true
        }, options);


        return this.each(function () {
            var
                $this = $(this),
                flybtn = $this.find(settings.button),
                target = $(settings.target),
                itemList = $this.find(settings.item);

            flybtn.on('click', function (e) {
                if (limitCart < 12) {
                    e.preventDefault();
                    var _this = $(this),
                        eltoDrag = _this.parent().find("img").eq(0);
                    if (eltoDrag) {
                        var imgclone = eltoDrag.clone()
                            .offset({
                                top: eltoDrag.offset().top,
                                left: eltoDrag.offset().left
                            })
                            .css({
                                'opacity': '0.5',
                                'position': 'absolute',
                                'height': eltoDrag.height() * 150,
                                'width': eltoDrag.width() * 150,
                                'z-index': '901'
                            })
                            .appendTo($('body'))
                            .animate({
                                'top': target.offset().top + 10,
                                'left': target.offset().left + 15,
                                'height': eltoDrag.height() / 4,
                                'width': eltoDrag.width() / 4
                            }, 2000, 'easeInOutExpo');
                        // 'height': eltoDrag.height() / 2,
                        // 'width': eltoDrag.width() / 2

                        if (settings.shake) {
                            setTimeout(function () {
                                target.effect("shake", {
                                    times: 2
                                }, 200);
                            }, 1500);
                        }

                        imgclone.animate({
                            'width': 0,
                            'height': 0
                        }, function () {
                            $(this).detach()
                        });
                    }
                }

            });
        });
    }
})(jQuery, window, document);