/**
 *
 * @authors JiangDing (jiangdingjd@gmail.com)
 * @date    2017-11-06 14:10:05
 * @version 0.1
 */

;(function($, window, document){

    // 定义插件名字
    var pluginName = "alertBox";
    // 设置插件默认参数
    var defaults = {
        zIndex: 99999,  //弹出层定位层级
        title: '',  //标题文字
        lTxt: '',   //左边按钮文字内容
        lBgColor: "#D4D4D4",  //左边按钮背景颜色
        lFontColor: "#333",   //左边按钮文字颜色
        lTxtClass : 'btn btn-default',
        lCallback: function(){},    //左边按钮回调函数
        rTxt: '',   //右边按钮文字内容
        rTxtClass : 'btn btn-primary',
        rBgColor: "#ED6465",  //右边按钮背景颜色
        rFontColor: "#fff",   //右边按钮文字颜色
        rCallback: function(){}   //右边按钮回调函数
    };

    function AlertBox(element, options){
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this.init();
    }

    AlertBox.prototype = {
        // 初始化弹窗
        init: function(){
            var that = this;
            var element = this.element;

            that.render(element);
            that.setStyle();
            that.show();
            that.trigger(element);
        },

        // 创建弹窗
        create: function(element){
            var that = this,
                $this = $(element),
                title = that.settings.title,
                zIndex = that.settings.zIndex,
                lTxt = that.settings.lTxt,
                lTxtClass = that.settings.lTxtClass,
                rTxtClass = that.settings.rTxtClass,
                rTxt = that.settings.rTxt,

                alertHTML = [];

            alertHTML[0] = '<div class="alert-panel"><h3 class="alert-message">' + title + '</h3>';
            alertHTML[1] = '<div class="h-list flex-h-center buttons">';
            alertHTML[2] = '';
            alertHTML[3] = '';
            if (lTxt!="") { alertHTML[2] = '<button class="alert_left_btn ' + lTxtClass + '">'+ lTxt + '</button>'; }
            if (rTxt!="") { alertHTML[3] = '<button class="alert_right_btn ' + rTxtClass + '">' + rTxt + '</button>';}
            alertHTML[4] = '</div>';
            alertHTML[5] = '<div class="cross-icon">x</div>';
            alertHTML[6] = '<div class="alert-mask"></div>';
            return alertHTML;
        },

        // 渲染弹窗
        render: function(element){
            var that = this,
                $this = $(element),
                alertHTML = that.create($this);
            // console.log(alertHTML);
            $('body').append('<div id="alert_box"></div>');

            $('#alert_box').replaceWith(alertHTML[0] + alertHTML[1] + alertHTML[2] + alertHTML[3] + alertHTML[4] + alertHTML[5] + alertHTML[4]);
            $('body').append(alertHTML[6]);
        },

        // 显示弹窗
        show: function(){
            setTimeout(function(){
                $('.alert-panel').addClass('show');
            },50);

            $('.alert-mask').show();
        },

        // 隐藏弹窗
        hide: function(element){
            var $this = $(element),
                $alertBox = $('.alert-panel');

            // 优化处理（如果不remove掉，多次触发弹窗会生成很多新的DOM）
            $alertBox.remove();
            setTimeout(function(){
                $('.alert-mask').remove();
            },150)
        },

        // 设置弹窗样式
        setStyle: function(){
            var that = this;

            // 设置弹窗定位层级
            $('.alert-panel').css({
                'z-index': that.settings.zIndex
            });

            //遮罩层样式
            $('.alert-mask').css({
                'height': $(window).height() + 'px',
                'z-index': that.settings.zIndex - 1
            });

            // 按钮样式
        },

        // 弹窗系列事件
        trigger: function(element, event){
            var that = this,
                $this = $(element);

            // 关闭弹窗事件触发
            $('.alert-panel .cross-icon, .alert_left_btn, .alert_right_btn').on('click',function(){
                that.hide();
                $('.alert-panel').removeClass('show');
                $('.alert-mask').remove();
            });

            // 左边按钮回调处理
            if($.isFunction(that.settings.lCallback)){
                $('.alert_left_btn').on('click',function(){
                    that.settings.lCallback();
                });
            }

            // 右边按钮回调处理
            if($.isFunction(that.settings.rCallback)){
                $('.alert_right_btn').on('click',function(){
                    that.settings.rCallback();
                });
            }
        }
    };

    // 调用
    $.fn[pluginName] = function(options) {
        this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new AlertBox(this, options));
            }
            new AlertBox(this, options);
        });
        return this;
    };

})(jQuery, window, document);
