(function($) {
	 var optDefaults = { 
			   btnWidth : "240", 
			   btnHeight : "50", 
			   baseURL: "http://isis.bughunter.cn/captcha/",
			   successCallback:null
			   
	 };
	 var opts = {};
	 	 this.btnWidth = '240'; // 触发按钮默认宽度
         this.btnHeight = '50'; // 触发按钮默认高度
        // prd
        this.baseURL = 'http://isis.bughunter.cn/captcha/';
       //this.baseURL = "/captcha/"
		this.signStr="";
        this.isShow = false; // 是否显示验证页
        this.isSuccess = false; // 是否验证成功
        this.isGetData = false; // 图片数据是否获取成功
        this.times = 0; // 验证次数
        this.successCallback;
        this.unix=0;
	 $.fn.clickVerification=function(pic,options){ 
		
		 var obj=$(this);
		 var id=obj.attr("id");
		 opts = $.extend(optDefaults, options);
		 if(obj.length<1 && !isAready){
			 alert("the selected object don't exist.");
			 return false;
		 }
		 init(obj);
      };
  
    init=function (obj) {
            this.createElement(obj);
           // this.bindElementEvent(obj);
            bindEvent(obj);
            if (obj.length > 0) {
                obj.append(this.main);
            } else {
                this.domBody.append(this.main);
            }
        },
        // 创建页面元素
        createElement=function (obj) {
            this.domBody = $(document.body);
            this.main = $('<div  class="Trigger_slider"></div>');
            this.oGuide = $('<div class="validate_oGuide"></div>');
            this.main.append(this.oGuide);
            this.oMain = $('<div  class="validate_main"></div>');
            this.oBig = $('<img  class="validate_big">');
            this.oAll = $('<img  class="validate_all">');
            this.oTimeBox = $('<div  class="validate_time"></div>');
            this.oLoad = $('<div  class="validate_load">加载中，请稍后</div>');
            this.oMain.append(this.oBig);
            this.oMain.append(this.oAll);
            this.oMain.append(this.oTimeBox);
            this.oMain.append(this.oLoad);
            this.main.append(this.oMain);
            this.obox = $('<div class="validate_box"></div>');
            this.prompt = $('<div class="validate_prompt2">依次点击图片上的 ’<span id="word1"></span>‘，’<span id="word2"></span>‘，’<span id="word3"></span>‘，完成验证。</div>');
            this.oProgress = $('<div class="validate_progress"></div>');
            this.obox.append(this.prompt);
            this.obox.append(this.oProgress);
            this.main.append(this.obox);
            var hr = $('<hr class="validate_underline" />');
            this.main.append(hr);
            var refresh = $('<div class="validate_refresh"></div>');
            this.refreshBox = $('<div class="validate_refresh_box"></div>');
            var refreshContent = $('<div class="validate_refresh_content">刷新</div>');
            this.icon = $('<div class="validate_icon"></div>');
            var content = $('<span class="validate_content">技术支持：bughunter.cn</span>');
            this.refreshBox.append(this.icon);
            this.refreshBox.append(refreshContent);
            refresh.append(this.refreshBox);
            refresh.append(content);
            this.main.append(refresh);
            this.sliderIcon = $('<div class="Trigger_slider_icon"></div>');
            this.sliderLogo = $('<div class="Trigger_slider_logo"></div>');
            this.sliderText = $('<span class="Trigger_slider_text">点击进行验证</span>');
            this.sliderButton = $('<div class="Trigger_slider_button"></div>');
            this.hiddenInput = $('<input type="hidden" name="applyId" id="apply_id" />');
            this.sliderButton.append(this.sliderIcon);
            this.sliderButton.append(this.sliderLogo);
            this.sliderButton.append(this.sliderText);
            obj.append(this.sliderButton);
            obj.append(this.hiddenInput);
            this.sliderButton.css({
                "text-align": 'center',
                "position": 'relative',
                "height": this.btnHeight + 'px',
                "width": this.btnWidth + 'px',
                "line-height": this.btnHeight + 'px'
            });

            obj.css({
                "text-align": 'center',
                "position": 'relative',
                "height": this.btnHeight + 'px',
                "width": this.btnWidth + 'px',
                "line-height": this.btnHeight + 'px'
            });
        },
      bindEvent=function (obj) {
            var that = this;
          
           obj.unbind("click");
           obj.bind("click",function (e) {
                if (!that.isSuccess) {
                   that.showLayer();
                   that.getData();
                }
                //obj.unbind("click");
               this.isShow = !that.isShow;
            });
            
			that.oAll.on('click',function(e){
			    //获取鼠标在图片上的坐标
			    //获取元素相对于页面的坐标
			    if(that.signStr==""){
			   		that.signStr+=e.offsetX+","+e.offsetY;
			    }else{
			     	that.signStr+=";"+e.offsetX+","+e.offsetY;
			    }
			    addLogo(e.offsetX,e.offsetY,1);
			    
			    return false;
			});
			that.refreshBox.on('click', function () {
                if (!that.isSuccess && that.isGetData) {
                    that.getData();
                }
                $("div").remove(".captcha-icon-point");
            });
            that.stopEvent();
            $.ajaxSetup({
                cache: false
            });
        },
        stopEvent=function () {
            var that = this;
            that.main.on("click", function (e) {
                e = window.event || e;
                if (e.stopPropagation) {
                    e.stopPropagation();
                } else {
                    e.cancelBubble = true;
                }
            });
           
        },
        // 其他地方触发弹层，目前在移动端没有点击按钮代码触发
        showLayer=function () {
            var that = this;
            this.main.show();
            if (!that.isSuccess) {
                if (!that.isShow) {
                    that.main.show();
                       this.isShow = true;
                } else {
                    that.main.hide();
                     this.isShow = false;
                }
            } else {
            }
        },
        // 获取图片url数据
        getData=function () {
            var that = this;
            that.isGetData = false;
            this.oLoad.show();
            // 静态数据
            var res = {};
            $.ajax({
                url: this.baseURL + 'randomClickCaptcha.htm',
                type: 'post',
                async: false,
                // 使用同步的方式,true为异步方式
                success: function (data) {
                		console.log(data);
                        var obj = JSON.parse(data);
                        res = obj.data;
                        that.unix=res.challenge;
                         $("#word1").html(res.word_0);
                         $("#word2").html(res.word_1);
                         $("#word3").html(res.word_2);
                         $("#apply_id").val(res.model.challenge);
                    },
                    fail: function () {
                        // code here...
                    }
            });

            that.isGetData = true;
            that.times = 0;
            that.times = 0;
             this.oAll.attr({
                'src': res.bkimgurl
            }).css({
                "width": '100%',
                "height": "100%",
                "z-index": '10',
                "position": 'absolute',
                "left": 0,
                "top": 0
            });
            setTimeout(function () {
                that.oLoad.hide();
            }, 200);

        },
       addLogo=function(x,y,idx){
       	 var that = this;
       	  this.logoDiv = $('<div   class="captcha-icon-point  captcha-point-'+that.times+'" style="left: '+(x-15)+'px; top: '+(y-30)+'px; z-index: 1000;"></div>');
       	  that.oAll.after(logoDiv);
       	  if(this.times<2){
       	 	 that.times++;
       	  }else{
       	  	that.verification(that.signStr);
       	  }
       }
        // 验证
        verification=function (signStr) {
            var that = this;
            // 服务端校验
            var url = "clickValidate.htm";
            var str='{"signStr":"'+signStr+'","applyId":"'+that.unix+'"}';
            $.ajax({
                    url: this.baseURL + url+"?str=" + encrypt(str),
                    dataType: 'json'
                }).then(function (res) {
                        if (res.status == "200") {
                             window.isSuccess=true;
                            that.isSuccess = true;
                            success();
                        } else {
                            window.isSuccess = false;
                            $("div").remove(".captcha-icon-point");
                            that.fail()
                            that.signStr="";
                        }
                    },
                    function (err) {
                        // console.log(err)
                    })
                // that.fail(startLeft)
                // 静态操作
                // var cert = 'e61dac1329b5415f91289457360ab1f5';
                // window.cert = cert;
                // localStorage.setItem('token', cert);
                // that.success()
        },
        //验证成功
        success=function () {
            that = this;
            that.endTime = new Date().getTime();;
            that.time = ((this.endTime - this.startTime) / 1000).toFixed(1);
            if (that.time >= 20) {
                that.time = 20;
            }
            that.oTimeBox.css({
                background: '#1FCA74'
            }).html(that.time + '秒的速度，超过了' + Math.round(100 - (that.time / 20).toFixed(2) * 100) + '%的用户').show();
            that.refreshBox.css({
                color: '#dddee1'
            });
            that.icon.css({
                'background-position': '-140px 0'
            });
            that.isSuccess = true;
            setTimeout(function () {
                    var status = that.isSuccess;
                     if(opts.successCallback && opts.successCallback instanceof Function){
				          opts.successCallback(status);
				    }
                    that.main.hide();
                    // 触发按钮
                    that.sliderButton.css({
                        "border": "1px solid #dddee1",
                        "background": 'rgba(31,202,0,0.1)'
                    });
                    that.sliderIcon.css({
                        "background-position": '-60px 0',
                        'width': "20px",
                        'margin-top': "-10px"
                    });
                    that.sliderLogo.show();
                    that.sliderText.html("验证成功").show().css({
                        color: '#1FCA74'
                    });
                    that.movex = 0;
                },
                200);
        },
        // 验证失败
        fail=function () {
            var that = this;
            this.oTimeBox.html("图像貌似没有拼合哦，请重新尝试");
            this.oTimeBox.css({
                background: '#F44336'
            });
            this.oTimeBox.show();
            setTimeout(function () {
                    that.oTimeBox.hide()
                },
                1000);
            this.shakeMove({
                obj: this.main[0],
                attr: 'left'
            });
            setTimeout(function () {
                    that.oAll.show();
                    // 失败三次重新获取图片
                    if (that.times >= 2) {
                        that.getData();
                    } else {
                        that.times++;
                    }
                },
                500)
        },
       
        // 获取当前样式
        getStyle=function (element, att) {
            if (window.getComputedStyle) {
                // 优先使用W3C规范
                return window.getComputedStyle(element)[att];
            } else {
                // 针对IE9以下兼容
                return element.currentStyle[att];
            }
        },
        // 抖动效果
        shakeMove=function (json) {
            // 声明要进行抖动的元素
            var obj = json.obj;
            // 声明元素抖动的最远距离
            var target = json.target;
            // 默认值为5
            target = Number(target) || 5;
            // 声明元素的变化样式
            var attr = json.attr;
            // 默认为'left'
            attr = attr || 'left';
            // 声明元素的起始抖动方向
            var dir = json.dir;
            // 默认为'1'，表示开始先向右抖动
            dir = Number(dir) || '1';
            // 声明元素每次抖动的变化幅度
            var stepValue = json.stepValue;
            stepValue = Number(stepValue) || 2;
            // 声明回调函数
            var fn = json.fn;
            // 声明步长step
            var step = 0;
            // 保存样式初始值
            var attrValue = parseFloat(this.getStyle(obj, attr));
            // 声明参照值value
            var value;
            // 清除定时器
            if (obj.timer) {
                return;
            }
            // 开启定时器
            obj.timer = setInterval(function () {
                    // 抖动核心代码
                    value = dir * (target - step);
                    // 当步长值大于等于最大距离值target时
                    if (step >= target) {
                        step = target
                    }
                    // 更新样式值
                    obj.style[attr] = attrValue + value + 'px';
                    // 当元素到达起始点时，停止定时器
                    if (step == target) {
                        clearInterval(obj.timer);
                        obj.timer = 0;
                        // 设置回调函数
                        fn && fn.call(obj);
                    }
                    // 如果此时为反向运动，则步长值变化
                    if (dir === -1) {
                        step = step + stepValue;
                    }
                    // 改变方向
                    dir = -dir;
                },
                50);
        }
        getCookie=function(c_name)
		{
		    if (document.cookie.length > 0)     {
		        c_start = document.cookie.indexOf(c_name + "=")           
		        if (c_start != -1){ 
		            c_start = c_start + c_name.length + 1 
		            c_end = document.cookie.indexOf(";", c_start) 
		            if (c_end == -1)   
		                c_end = document.cookie.length   
		                return unescape(document.cookie.substring(c_start, c_end))   
		            } 
		        } 
		    return "" 
		}
		setCookie=function(name,value){
		    var Days = 30;
		    var exp = new Date();
		    exp.setTime(exp.getTime() + Days*24*60*60*1000);
		    document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
		}
		 encode16 = function (str){
		    str=str.toLowerCase();
		    if (str.match(/^[-+]?\d*$/) == null){//非整数字符，对每一个字符都转换成16进制，然后拼接
		        var s=str.split("");
		        var temp="";
		        for(var i=0;i<s.length;i++){
		            s[i]=s[i].charCodeAt();//先转换成Unicode编码
		            s[i]=s[i].toString(16);
		            temp=temp+s[i];
		        }
		        return temp+"{"+1;//1代表字符
		    }else{//数字直接转换成16进制
		        str=parseInt(str).toString(16);
		    }
		    return str+"{"+0;//0代表纯数字
		}
		 
		 
		produceRandom = function (n){
		    var num=""; 
		    for(var i=0;i<n;i++) 
		    { 
		        num+=Math.floor(Math.random()*10);
		    } 
		    return num;
		}
	//主加密函数
	encrypt = function (str){
	    var encryptStr="";//最终返回的加密后的字符串
	    encryptStr+=produceRandom(3);//产生3位随机数
	    var temp=encode16(str).split("{");//对要加密的字符转换成16进制
	    var numLength=temp[0].length;//转换后的字符长度
	    numLength=numLength.toString(16);//字符长度换算成16进制
	    if(numLength.length==1){//如果是1，补一个0
	        numLength="0"+numLength;
	    }else if(numLength.length>2){//转换后的16进制字符长度如果大于2位数，则返回，不支持
	        return "";
	    }
	    encryptStr+=numLength;
	     
	    if(temp[1]=="0"){
	        encryptStr+=0;
	    }else if(temp[1]=="1"){
	        encryptStr+=1;
	    }
	     
	    encryptStr+=temp[0];
	     
	    if(encryptStr.length<20){//如果小于20位，补上随机数
	        var ran=produceRandom(20-encryptStr.length);
	        encryptStr+=ran;
	    }
	    return encryptStr;
	}
})(jQuery);  