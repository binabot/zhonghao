
(function($, Drupal) {

  'use strict';

  Drupal.behaviors.custom = {
    attach: function(context, settings) {


      // Menu
      $('.sf-menu').superfish();

      // Front page
      $('#front-logos-slider').bxSlider({
        slideWidth: 200,
        minSlides: 2,
        maxSlides: 10,
        moveSlides: 1,
        pager: false,
      });
      if ($('#camera').length) {
        $('#camera').camera({
            autoAdvance: true,
            height: '25.87890625%',
            minHeight: '300px',
            pagination: false,
            thumbnails: false,
            playPause: false,
            hover: false,
            loader: 'none',
            navigation: true,
            navigationHover: false,
            mobileNavHover: false,
            fx: 'simpleFade'
        });
      }

      // Projects page
      $('.thumb').fancybox();

      // Mail forms
      /*
      $('.mailform').submit(function(e) {
        e.preventDefault(e);
        var name  = $.trim($(this).find('.name').val());
        var phone = $.trim($(this).find('.phone').val());
        var email = $.trim($(this).find('.email').val());
        var message = $.trim($(this).find('.message').val());
        if (!name.length || !email.length || !message.length) {
          return false;
        }
        $.ajax({
          type: 'POST',
          data: {name: name, phone: phone, email: email, message: message},
          url: '/' + settings.path.currentLanguage + '/' + settings.path.currentPath,
          beforeSend: function() {
            $("#ajax-loader-wrapper").removeClass('hide');
          },
          complete: function(){
            $("#ajax-loader-wrapper").addClass('hide');
          },
          success: function(data) {
            if (data.status === 'success') {

            }
          }
        });
      });
      */

      // Baidu map pages
      if ($('#dituContent').length) {
        //创建和初始化地图函数：
        function initMap(){
            createMap();//创建地图
            setMapEvent();//设置地图事件
            addMapControl();//向地图添加控件
        }

        //创建地图函数：
        function createMap(){
          var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
          var point = new BMap.Point(113.880394, 22.589115);//定义一个中心点坐标
          map.centerAndZoom(point, 14);//设定地图的中心点和坐标并将地图显示在地图容器中
          window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent(){
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            // map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }

        //地图控件添加函数：
        function addMapControl(){
            //向地图中添加缩放控件
            var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
            map.addControl(ctrl_nav);
                  //向地图中添加缩略图控件
            var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:1});
            map.addControl(ctrl_ove);
                  //向地图中添加比例尺控件
            var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
            map.addControl(ctrl_sca);
        }
        initMap();//创建和初始化地图
      }


    }
  };

})(jQuery, Drupal);
