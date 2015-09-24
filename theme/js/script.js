(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

(function( $ ){

var t_browser_has_css3;
var t_css3_array = ['transition','-webkit-transition','-moz-transition','-o-transition','-ms-transition'];
var t_css3_index;
$(document).ready(function(){
    var t_css3_test = $('body');
    for(t_css3_index=0, t_css3_test.css(t_css3_array[t_css3_index],'');t_css3_index<t_css3_array.length&&(null===t_css3_test.css(t_css3_array[t_css3_index])||undefined===t_css3_test.css(t_css3_array[t_css3_index]));){
        t_css3_index++;
        if(t_css3_index<t_css3_array.length) t_css3_test.css(t_css3_array[t_css3_index],'');
    };
    if(t_css3_index<t_css3_array.length)
        t_browser_has_css3 = true;
    else
        t_browser_has_css3 = false;
    load_portofolio_hover_effect();
    load_main_slider();
    load_flickr();
    load_twitter();
    load_page_slider();
    load_clients_slider();
    load_project_related_slider();
    load_works();
    load_menu();
    load_contacts();
    load_testimonial();
});



//PORTOFOLIO HOVER EFFECT
var load_portofolio_hover_effect = function(){
    var t_enabled = !$.browser.mobile;
    var t_window = $(window);
    $('.works').each(function(){
        var t_hover_time = 300;   //time for hover effect
        var t = $(this);
        var t_container = t.children('.worksContainer');
        var t_items_hover_on_function;
        var t_items_hover_off_function;
        var t_items_hover_class = 'worksContainerView1';
        var t_rtl = t.css('direction')==='rtl';
        var t_prop_on = t_rtl?{marginRight:'-100%'}:{marginLeft:'0%'};
        var t_porp_off = t_rtl?{marginRight:'0%'}:{marginLeft:'-100%'};
        if(t_browser_has_css3){
            t_container.children('.worksEntry').children('.worksEntryContainer').css(t_css3_array[t_css3_index],'margin-left '+t_hover_time/1000+'s ease-in-out, margin-right '+t_hover_time/1000+'s ease-in-out');
            t_items_hover_on_function = function(){
                if(t_enabled&&t_container.hasClass(t_items_hover_class)){
                    $(this).children('.worksEntryContainer').css(t_prop_on);
                }
            };
            t_items_hover_off_function = function(){
                if(t_container.hasClass(t_items_hover_class)){
                    $(this).children('.worksEntryContainer').css(t_porp_off);
                }
            };
        }else{
            t_items_hover_on_function = function(){
                if(t_enabled&&t_container.hasClass(t_items_hover_class)){
                    $(this).children('.worksEntryContainer').stop().animate(t_prop_on,{duration:t_hover_time,queue:false,easing:'swing'});
                }
            };
            t_items_hover_off_function = function(){
                if(t_container.hasClass(t_items_hover_class)){
                    $(this).children('.worksEntryContainer').stop().animate(t_porp_off,{duration:t_hover_time,queue:false,easing:'swing'});
                }
            };
        }
        t_container.children('.worksEntry:not(.no_effect)').hover(t_items_hover_on_function, t_items_hover_off_function);
    });
};



//MAIN SLIDER
var load_main_slider = function(){
    $('.mainSlider').each(function(){
        var t_nav_time = 400;   //time for navigation bar movement
        var t_items_time = 400;   //time for item transition
        var t_interval_time = 2000;   //time for autoplay slide change
        var t_timeout_time = 8000;   //time to wait on clicked slide before autoplay resumes
        var t = $(this);
        t_interval_time = t.attr('data-speed')===undefined?t_interval_time:t.attr('data-speed');
        t_timeout_time = t.attr('data-pause')===undefined?t_interval_time:t.attr('data-pause');
        var t_items_container =  t.children('.mainSliderItemsWrapper').children('.mainSliderItems');
        var t_items = t_items_container.children('.mainSliderItemsEntry');
        if(!t_items.length) return;
        var t_items_active_class = 'mainSliderItemsEntryActive';
        t_items.eq(0).addClass(t_items_active_class);
        var t_items_active_selector = '.'+t_items_active_class;
        var t_nav_container = t.children('.mainSliderNav');
        var t_nav = t_nav_container.children('.mainSliderNavBar');
        //var t_nav_width = Math.floor(t_nav_container.innerWidth()/t_items.length);
        var t_nav_width_measure = '%';
        var t_nav_width = 100/t_items.length;
        var t_prev = t.find('.mainSliderItemsEntryBoxButtonsPrev');
        var t_next = t.find('.mainSliderItemsEntryBoxButtonsNext');
        var t_index = 0;
        var t_index_max = t_items.length - 1;
        t_nav.css({width:t_nav_width+t_nav_width_measure});
        var t_prev_function;
        var t_next_function;
        t_items.css({opacity:0});
        while(t_items.css('opacity')!=='0');
        var t_timeout = 0;
        var t_interval = 0;
        var t_interval_function;
        var t_play = function(){
            t_interval = setInterval(t_interval_function,t_interval_time);
        };
        var t_resume = function(){
            clearInterval(t_interval);
            clearTimeout(t_timeout);
            t_timeout = setTimeout(function(){
                t_interval_function();
                t_play();
            },t_timeout_time);
        };
        var t_stop = function(){
            clearInterval(t_interval);
            clearTimeout(t_timeout);
        };
        if(t_browser_has_css3){
            t_items.css(t_css3_array[t_css3_index],'opacity '+t_items_time/1000+'s ease-in-out');
            t_items.filter(t_items_active_selector).css({opacity:1});
            t_nav.css(t_css3_array[t_css3_index],'margin-left '+t_nav_time/1000+'s ease-in-out');
            t_prev_function = function(){
                t_index--;
                if(t_index<0)
                    t_index = t_index_max;
                t_nav.css({marginLeft: t_nav_width*t_index+t_nav_width_measure});
                t_items.filter(t_items_active_selector).css({opacity:0}).removeClass(t_items_active_class);
                t_items.filter(':eq('+t_index+')').css({opacity:1}).addClass(t_items_active_class);
            };
            t_next_function = function(){
                t_index++;
                if(t_index>t_index_max)
                    t_index = 0;
                t_nav.css({marginLeft: t_nav_width*t_index+t_nav_width_measure});
                t_items.filter(t_items_active_selector).css({opacity:0}).removeClass(t_items_active_class);
                t_items.filter(':eq('+t_index+')').css({opacity:1}).addClass(t_items_active_class);
            };
            t_interval_function = function(){
                t_index++;
                if(t_index>t_index_max)
                    t_index = 0;
                t_nav.css({marginLeft: t_nav_width*t_index+t_nav_width_measure});
                t_items.filter(t_items_active_selector).css({opacity:0}).removeClass(t_items_active_class);
                t_items.filter(':eq('+t_index+')').css({opacity:1}).addClass(t_items_active_class);
            };
        }else{
            t_items.filter(t_items_active_selector).stop().animate({opacity:1},{duration:t_items_time,queue:false,easing:'swing'});
            t_prev_function = function(){
                t_index--;
                if(t_index<0)
                    t_index = t_index_max;
                t_nav.stop().animate({marginLeft: t_nav_width*t_index+t_nav_width_measure},{duration:t_nav_time,queue:false,easing:'swing'});
                t_items.filter(t_items_active_selector).stop().animate({opacity:0},{duration:t_items_time,queue:false,easing:'swing'}).removeClass(t_items_active_class);
                t_items.filter(':eq('+t_index+')').stop().animate({opacity:1},{duration:t_items_time,queue:false,easing:'swing'}).addClass(t_items_active_class);
            };
            t_next_function = function(){
                t_index++;
                if(t_index>t_index_max)
                    t_index = 0;
                t_nav.stop().animate({marginLeft: t_nav_width*t_index+t_nav_width_measure},{duration:t_nav_time,queue:false,easing:'swing'});
                t_items.filter(t_items_active_selector).stop().animate({opacity:0},{duration:t_items_time,queue:false,easing:'swing'}).removeClass(t_items_active_class);
                t_items.filter(':eq('+t_index+')').stop().animate({opacity:1},{duration:t_items_time,queue:false,easing:'swing'}).addClass(t_items_active_class);
            };
            t_interval_function = function(){
                t_index++;
                if(t_index>t_index_max)
                    t_index = 0;
                t_nav.stop().animate({marginLeft: t_nav_width*t_index+t_nav_width_measure},{duration:t_nav_time,queue:false,easing:'swing'});
                t_items.filter(t_items_active_selector).stop().animate({opacity:0},{duration:t_items_time,queue:false,easing:'swing'}).removeClass(t_items_active_class);
                t_items.filter(':eq('+t_index+')').stop().animate({opacity:1},{duration:t_items_time,queue:false,easing:'swing'}).addClass(t_items_active_class);
            };
        }
        t_prev.click(t_prev_function);
        t_next.click(t_next_function);
        t_prev.mousedown(function(){
            return false;
        });
        t_next.mousedown(function(){
            return false;
        });
        t_play();
        t_items.hover(function(){
            t_stop();
        },function(){
            t_resume();
        });
    });
};



//FLICKR
var load_flickr = function(){
    $('.widgetFlickr').each(function(){
        var stream = $(this);
        var stream_userid = stream.attr('data-user');
        var stream_items = parseInt(stream.attr('data-images'));
        $.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?lang=en-us&format=json&id="+stream_userid+"&jsoncallback=?", function(stream_feed){
            for(var i=0;i<stream_items&&i<stream_feed.items.length;i++){
                (function(){
                    if(stream_feed.items[i].media.m){
                        if(t_browser_has_css3){
                            var stream_div = $('<div>').attr('style','position:relative;').addClass('widgetFlickrImg').addClass('bordercolor4');
                            var stream_a = $('<a>').attr('style','position:absolute;top:0;left:0;right:0;bottom:0;background-repeat:no-repeat;background-size:cover;background-position:center;background-image:url('+stream_feed.items[i].media.m+');').attr('href',stream_feed.items[i].link).attr('target','_blank');
                            stream_div.append(stream_a);
                            stream.append(stream_div);
                        }else{
                            var stream_div = $('<div>').addClass('widgetFlickrImg').addClass('bordercolor4');
                            var stream_a = $('<a>').attr('href',stream_feed.items[i].link).attr('target','_blank');
                            stream_div.append(stream_a);
                            var stream_img = $('<img>').attr('src',stream_feed.items[i].media.m).attr('alt','').load(function(){
                                stream_a.append(stream_img);
                                if(stream_img.width()<stream_img.height())
                                    stream_img.css({width:'100%',height:'auto'});
                                else
                                    stream_img.css({width:'auto',height:'100%'});
                            });
                            stream.append(stream_div);
                        }
                    }
                })();
            }
        });
    });
};



//TWITTER
var load_twitter = function(){return;
    var linkify = function(text){
        text = text.replace(/(https?:\/\/\S+)/gi, function (s) {
            return '<a class="textcolor7" href="' + s + '">' + s + '</a>';
        });
        text = text.replace(/(^|)@(\w+)/gi, function (s) {
            return '<a class="textcolor7" href="http://twitter.com/' + s + '">' + s + '</a>';
        });
        text = text.replace(/(^|)#(\w+)/gi, function (s) {
            return '<a class="textcolor7" href="http://search.twitter.com/search?q=' + s.replace(/#/,'%23') + '">' + s + '</a>';
        });
        return text;
    }
    $('.widgetTwitter').each(function(){
        var t = $(this);
        var t_date_obj = new Date();
        var t_loading = 'Loading tweets..'; //message to display before loading tweets
        var t_user = t.attr('data-user');
        var t_posts = parseInt(t.attr('data-posts'));
        t.append(t_loading);
        $.getJSON("http://api.twitter.com/1/statuses/user_timeline/"+t_user+".json?callback=?", function(t_tweets){
            t.empty();
            for(var i=0;i<t_posts&&i<t_tweets.length;i++){
                var t_date = Math.floor((t_date_obj.getTime()-Date.parse(t_tweets[i].created_at))/1000);
                var t_date_str;
                var t_date_seconds = t_date%60;
                t_date=Math.floor(t_date/60);
                var t_date_minutes = t_date%60;
                if(t_date_minutes){
                    t_date=Math.floor(t_date/60);
                    var t_date_hours = t_date%24;
                    if(t_date_hours){
                        t_date=Math.floor(t_date/24);
                        var t_date_days = t_date%7;
                        if(t_date_days){
                            t_date=Math.floor(t_date/7);
                            var t_date_weeks = t_date;
                            if(t_date_weeks)
                                t_date_str = t_date_weeks+' week'+(1==t_date_weeks?'':'s')+' ago';
                            else
                                t_date_str = t_date_days+' day'+(1==t_date_days?'':'s')+' ago';
                        }
                        else
                            t_date_str = t_date_hours+' hour'+(1==t_date_hours?'':'s')+' ago';
                    }
                    else
                        t_date_str = t_date_minutes+' minute'+(1==t_date_minutes?'':'s')+' ago';
                }
                else
                    t_date_str = 'less than a minute ago';
                var t_message =
                    (i?'<div class="widgetPostsEntryDelimiter widgetPostsEntryDelimiterSmall"></div>':'')+
                    '<div class="widgetTwitterPost">'+
                        '<div class="widgetTwitterPostText">'+
                            linkify(t_tweets[i].text)+
                        '</div>'+
                        '<div class="widgetTwitterPostDate textcolor8">'+
                            t_date_str+
                        '</div>'+
                    '</div>';
                t.append(t_message);
            }
        });
    });
};



//PAGE SLIDER
var load_page_slider = function(){
    $('.pageSlider').each(function(){
        var t_items_time = 400;   //time for slide animation
        var t_interval_time = 2000;   //time for autoplay slide change
        var t_timeout_time = 8000;   //time to wait on clicked slide before autoplay resumes
        var t_timeout = 0;
        var t_interval = 0;
        var t_interval_function;
        var t = $(this);
        t_interval_time = t.attr('data-speed')===undefined?t_interval_time:t.attr('data-speed');
        t_timeout_time = t.attr('data-pause')===undefined?t_interval_time:t.attr('data-pause');
        var t_items = t.children('.pageSliderItems').children('ul').children('li');
        var t_active_class = 'active';
        t_items.eq(0).addClass(t_active_class);
        t_items_n = t_items.length;
        if(!t_items_n) return;
        var i;
        var t_append = '<ul class="pageSliderNav">';
        for(i=0;i<t_items_n;i++)
                t_append += '<li></li>';
        t_append += '<li class="pageSliderNavFill"></li></ul>';
        t.append(t_append);
        var t_nav = t.children('.pageSliderNav').children('li').not('.pageSliderNavFill');
        t_nav.eq(0).addClass(t_active_class);
        var t_active_selector = '.'+t_active_class;
        t_items.css({opacity:0});
        while(t_items.css('opacity')!=='0');
        var t_nav_function;
        var t_play = function(){
            t_interval = setInterval(t_interval_function,t_interval_time);
        };
        var t_resume = function(){
            clearInterval(t_interval);
            clearTimeout(t_timeout);
            t_timeout = setTimeout(function(){
                t_interval_function();
                t_play();
            },t_timeout_time);
        }
        var t_stop = function(){
            clearInterval(t_interval);
            clearTimeout(t_timeout);
        }
        var t_index = 0;
        var t_index_max = t_items.length-1;
        var t_height = 0;
        t_items.children('img').each(function(i,e){
            var $e = $(e);
            if($e.height()>t_height)
                t_height = $e.height();
        });
        if(t_height)
            t.css({height: t_height});
        if(t_browser_has_css3){
            t_items.css(t_css3_array[t_css3_index],'opacity '+t_items_time/1000+'s ease-in-out');
            t_items.filter(t_active_selector).css({opacity:1});
            t_nav_function = function(){
                var t_nav_current = t_nav.filter(t_active_selector);
                if(t_nav_current.not(this).length){
                    t_nav_current.removeClass(t_active_class);
                    $(this).addClass(t_active_class);
                    t_items.filter(t_active_selector).css({opacity:0}).removeClass(t_active_class);
                    t_items.filter(':eq('+t_nav.index(this)+')').css({opacity:1}).addClass(t_active_class);
                    t_index = t_nav.index(this);
                }
                t_resume();
            };
            t_interval_function = function(){
                t_nav.filter(t_active_selector).removeClass(t_active_class);
                t_items.filter(t_active_selector).css({opacity:0}).removeClass(t_active_class);
                t_index++;
                if(t_index>t_index_max)
                    t_index = 0;
                t_nav.filter(':eq('+t_index+')').addClass(t_active_class);
                t_items.filter(':eq('+t_index+')').css({opacity:1}).addClass(t_active_class);
            };
            
        }else{
            t_items.filter(t_active_selector).stop().animate({opacity:1},{duration:t_items_time,queue:false,easing:'swing'});
            t_nav_function = function(){
                var t_nav_current = t_nav.filter(t_active_selector);
                if(t_nav_current.not(this).length){
                    t_nav_current.removeClass(t_active_class);
                    $(this).addClass(t_active_class);
                    t_items.filter(t_active_selector).stop().animate({opacity:0},{duration:t_items_time,queue:false,easing:'swing'}).removeClass(t_active_class);
                    t_items.filter(':eq('+t_nav.index(this)+')').stop().animate({opacity:1},{duration:t_items_time,queue:false,easing:'swing'}).addClass(t_active_class);
                    t_index = t_nav.index(this);
                }
                t_resume();
            };
            t_interval_function = function(){
                t_nav.filter(t_active_selector).removeClass(t_active_class);
                t_items.filter(t_active_selector).stop().animate({opacity:0},{duration:t_items_time,queue:false,easing:'swing'}).removeClass(t_active_class);
                t_index++;
                if(t_index>t_index_max)
                    t_index = 0;
                t_nav.filter(':eq('+t_index+')').addClass(t_active_class);
                t_items.filter(':eq('+t_index+')').stop().animate({opacity:1},{duration:t_items_time,queue:false,easing:'swing'}).addClass(t_active_class);
            };
        }
        t_nav.click(t_nav_function);
        t_play();
        t_items.hover(function(){
            t_stop();
        },function(){
            t_resume();
        });
    });
};



//CLIENTS SLIDER
var load_clients_slider = function(){
    $('.clients').each(function(){
        var t_time = 400;   //time for slide movement
        var t_visible;   //nr of visible items, different for each resolution
        var t = $(this);
        var t_items_container = t.children('ul');
        var t_items = t_items_container.children('li');
        var t_items_increment;
        var t_prev = t.find('.clientsNavPrev');
        var t_next = t.find('.clientsNavNext');
        var t_prev_function;
        var t_next_function;
        var t_index = 0;
        var t_index_max;
        var t_items_length = t_items.length;
        var t_with_sidebar = t.closest('.streched').length;
        if(t_browser_has_css3){
            t_items_container.css(t_css3_array[t_css3_index],'margin-left '+t_time/1000+'s ease-in-out');
            t_prev_function = function(){
                if(t_index>0){
                    t_index--;
                    t_items_container.css({marginLeft: -t_items_increment*t_index+'px'});
                }
            };
            t_next_function = function(){
                if(t_index<t_index_max){
                    t_index++;
                    t_items_container.css({marginLeft: -t_items_increment*t_index+'px'});
                }
            };
        }else{
            t_prev_function = function(){
                if(t_index>0){
                    t_index--;
                    t_items_container.stop().animate({marginLeft: -t_items_increment*t_index+'px'},{duration:t_time,queue:false,easing:'swing'});
                }
            };
            t_next_function = function(){
                if(t_index<t_index_max){
                    t_index++;
                    t_items_container.stop().animate({marginLeft: -t_items_increment*t_index+'px'},{duration:t_time,queue:false,easing:'swing'});
                }
            };
        }
        t_prev.click(t_prev_function);
        t_next.click(t_next_function);
        var t_w = $(window);
        var t_resolution = -1;
        var resize_function = function(){
            var w_width = t_w.width();
            var t_new_resolution = false;
            if(w_width<960)
                if(w_width<768)
                    if(w_width<480){
                        //width<480
                        if(t_resolution!==1){
                            t_new_resolution = true;
                            t_resolution = 1;
                            if(t_with_sidebar){
                                t_visible = 2;
                                t_items_increment = 156;
                            }else{
                                t_visible = 2;
                                t_items_increment = 156;
                            }
                            //t_items_increment = t_items.outerWidth(true);
                        }
                    }else{
                        //480<width<768
                        if(t_resolution!==2){
                            t_new_resolution = true;
                            t_resolution = 2;
                            if(t_with_sidebar){
                                t_visible = 3;
                                t_items_increment = 168;
                            }else{
                                t_visible = 3;
                                t_items_increment = 168;
                            }
                            //t_items_increment = t_items.outerWidth(true);
                        }
                    }else{
                        //768<width<960
                        if(t_resolution!==3){
                            t_new_resolution = true;
                            t_resolution = 3;
                            if(t_with_sidebar){
                                t_visible = 3;
                                t_items_increment = 178;
                            }else{
                                t_visible = 4;
                                t_items_increment = 208;
                            }
                            //t_items_increment = t_items.outerWidth(true);
                        }
                    }else{
                        //960<width
                        if(t_resolution!==4){
                            t_new_resolution = true;
                            t_resolution = 4;
                            if(t_with_sidebar){
                                t_visible = 4;
                                t_items_increment = 179;
                            }else{
                                t_visible = 5;
                                t_items_increment = 202;
                            }
                            //t_items_increment = t_items.outerWidth(true);
                        }
                    }
            if(t_new_resolution){
                t_index_max = Math.max(t_items_length - t_visible,0);
                t_items_container.css({width: t_items_increment*t_items_length+'px'});
                t_index = Math.min(t_index,t_index_max);
                t_items_container.stop().css({marginLeft: (t_items_length>t_visible?-t_items_increment*t_index:0)+'px'});
            }
        };
        t_w.resize(resize_function);
        resize_function();
    });
};



//PROJECT RELATED SLIDER
var load_project_related_slider = function(){
    $('.projectRelated').each(function(){
        var t_time = 400;   //time for slide movement
        var t_visible;   //nr of visible items
        var t = $(this);
        var t_items_container = t.children('ul');
        var t_items = t_items_container.children('li');
        var t_items_max_height = Math.max.apply(null,t_items.map(function() { return $(this).height(); }).get());
        var t_items_increment = t_items.outerWidth(true);
        var t_prev = t.find('.clientsNavPrev');
        var t_next = t.find('.clientsNavNext');
        var t_prev_function;
        var t_next_function;
        var t_index = 0;
        var t_index_max;
        var t_items_length = t_items.length;
        t_items.height(t_items_max_height);
        if(t_browser_has_css3){
            t_items_container.css(t_css3_array[t_css3_index],'margin-left '+t_time/1000+'s ease-in-out');
            t_prev_function = function(){
                if(t_index>0){
                    t_index--;
                    t_items_container.css({marginLeft: -t_items_increment*t_index+'px'});
                }
            };
            t_next_function = function(){
                if(t_index<t_index_max){
                    t_index++;
                    t_items_container.css({marginLeft: -t_items_increment*t_index+'px'});
                }
            };
        }else{
            t_prev_function = function(){
                if(t_index>0){
                    t_index--;
                    t_items_container.stop().animate({marginLeft: -t_items_increment*t_index+'px'},{duration:t_time,queue:false,easing:'swing'});
                }
            };
            t_next_function = function(){
                if(t_index<t_index_max){
                    t_index++;
                    t_items_container.stop().animate({marginLeft: -t_items_increment*t_index+'px'},{duration:t_time,queue:false,easing:'swing'});
                }
            };
        }
        t_prev.click(t_prev_function);
        t_next.click(t_next_function);
        var t_w = $(window);
        var t_resolution = -1;
        var resize_function = function(){
            var w_width = t_w.width();
            var t_new_resolution = false;
            if(w_width<960)
                if(w_width<768)
                    if(w_width<480){
                        //width<480
                        if(t_resolution!==1){
                            t_new_resolution = true;
                            t_resolution = 1;
                            t_visible = 1;
                            t_items_increment = 299;
                        }
                    }else{
                        //480<width<768
                        if(t_resolution!==2){
                            t_new_resolution = true;
                            t_resolution = 2;
                            t_visible = 2;
                            t_items_increment = 255;
                        }
                    }else{
                        //768<width<960
                        if(t_resolution!==3){
                            t_new_resolution = true;
                            t_resolution = 3;
                            t_visible = 3;
                            t_items_increment = 271;
                        }
                    }else{
                        //960<width
                        if(t_resolution!==4){
                            t_new_resolution = true;
                            t_resolution = 4;
                            t_visible = 4;
                            t_items_increment = 245;
                        }
                    }
            if(t_new_resolution){
                t_index_max = Math.max(t_items_length - t_visible,0);
                t_items_container.css({width: t_items_increment*t_items_length+'px'});
                t_index = Math.min(t_index,t_index_max);
                t_items_container.stop().css({marginLeft: (t_items_length>t_visible?-t_items_increment*t_index:0)+'px'});
            }
        };
        t_w.resize(resize_function);
        resize_function();
    });
};




//WORKS
var load_works = function(){
    $('.works').each(function(){
        var t = $(this);
        var t_default_view = t.attr('data-view');
        var t_filters = t.children('.worksFilter').children('ul.worksFilterCategories').children('li');
        var t_filters_active_class = 'worksFilterCategoriesActive';
        var t_filters_active_selector = '.'+t_filters_active_class;
        var t_views = t.children('.worksViews').children('.worksViewsOption');
        var t_views_active_class = 'worksViewsOptionActive';
        var t_views_active_selector = '.'+t_views_active_class;
        var t_container = t.children('.worksContainer');
        var t_categorized_object;
        var t_settings1 = {
            itemClass: 'worksEntry',
            time: 400,
            allCategory: 'all'
        };
        var t_options1 = [
            {
                resolution: 960,
                columns: 4,
                itemHeight: '*1'
            },
            {
                resolution: 768,
                columns: 4,
                itemHeight: '*1'
            },
            {
                resolution: 480,
                columns: 2,
                itemHeight: 240
            },
            {
                resolution: 300,
                columns: 2,
                itemHeight: 150
            }
        ];
        var t_settings2 = {
            itemClass: 'worksEntry',
            time: 400,
            allCategory: 'all'
        };
        var t_options2 = [
            {
                resolution: 960,
                columns: 1,
                itemHeight: 215,
                itemMarginBottom: 35
            },
            {
                resolution: 768,
                columns: 1,
                itemHeight: 172,
                itemMarginBottom: 35
            },
            {
                resolution: 480,
                columns: 1,
                itemHeight: 107,
                itemMarginBottom: 35
            },
            {
                resolution: 300,
                columns: 1,
                itemHeight: 67,
                itemMarginBottom: 35
            }
        ];
        var t_parameters = [[t_settings1,t_options1],[t_settings2,t_options2]];
        
        
        t_filters.click(function(){
            var t_filters_last = t_filters.filter(t_filters_active_selector).not(this);
            if(t_filters_last.length){
                t_filters_last.removeClass(t_filters_active_class);
                var t_filters_current = $(this);
                t_filters_current.addClass(t_filters_active_class);
                t_categorized_object.changeCategory(t_filters_current.attr('data-category'));
            }
        });
        t_views.click(function(){
            var t_views_last = t_views.filter(t_views_active_selector).not(this);
            if(t_views_last.length){
                t_views_last.removeClass(t_views_active_class);
                t_container.removeClass(t_views_last.attr('data-class'));
                var t_views_current = $(this);
                t_views_current.addClass(t_views_active_class);
                t_container.addClass(t_views_current.attr('data-class'));
                t_categorized_object.destroyCategorizedObject();
                var x_index = t_views.index(this);
                t_parameters[x_index][0].initialCategory = t_filters.filter(t_filters_active_selector).attr('data-category');
                t_categorized_object = t_container.categorized(t_parameters[x_index][0],t_parameters[x_index][1]);
            }
        });
        if('list'===t_default_view||('grid'!==t_default_view&&(($.browser.mobile&&revoke_main.listviewmobile)||(!$.browser.mobile&&revoke_main.listviewdesktop)))){

            var t_views_last = t_views.filter(t_views_active_selector);
            if(t_views_last.length){
                t_container.removeClass(t_views_last.attr('data-class'));
                var t_views_current = t_views.not(t_views_active_selector);
                t_views_last.removeClass(t_views_active_class);
                t_views_current.addClass(t_views_active_class);
                t_container.addClass(t_views_current.attr('data-class'));
            }

            t_categorized_object = t_container.categorized(t_parameters[1][0],t_parameters[1][1]);

        }else{
            t_categorized_object = t_container.categorized(t_parameters[0][0],t_parameters[0][1]);
        }
    });
};




//MENU
var load_menu = function(){
    $('.menuContainer select').each(function(){
        var t = $(this);
        t.change(function(){
            window.location=t.val();
        });
    });
}




//CONTACTS
var load_contacts = function(){
    $('.contactForm').each(function(){
        var t = $(this);
        var t_timeout;
        t.submit(function(event) {
            t.find('[type="submit"]').prop('disabled',true);
            t.next('.contactResult').text('');
            event.preventDefault();
            $.post(revoke_main.ajaxurl, t.serialize(),function(result){
                result = $.parseJSON(result);
                clearTimeout(t_timeout);
                t_timeout = setTimeout(function(){
                    t.find('[type="submit"]').prop('disabled',false);
                },1000);
                t.next('.contactResult').text(result.message);
            });
        }); 
    });
};




//TESTIMONIAL
var load_testimonial = function(){
    $('.testimonial_slider').each(function(){
        var t = $(this);
        var t_items = t.children('.testimonialbg');
        var t_items_nr = t_items.length;
        if(t_items_nr>1){
            var t_index = 0;
            var t_index_max = t_items_nr-1;
            var t_interval_time = 4;
            var t_timeout_time = 8;
            t_interval_time = t.attr('data-speed')===undefined?t_interval_time:t.attr('data-speed');
            t_timeout_time = t.attr('data-pause')===undefined?t_timeout_time:t.attr('data-pause');
            var t_speed = 1000;
            var t_timeout = 0;
            var t_interval = 0;
            var t_interval_function = function(){
                var t_index_old = t_index;
                if(t_index<t_index_max)
                    t_index++;
                else
                    t_index=0;
                t_items.eq(t_index).stop(true,true).css({opacity:0});
                t_items.eq(t_index_old).stop(true,true).css({opacity:1});
                t.css({height:t_items.eq(t_index_old).outerHeight(true)});
                t_items.eq(t_index_old).removeClass('testimonial_active');
                t_items.eq(t_index).addClass('testimonial_active');
                t.css({height:'auto'});
                t_items.eq(t_index).animate({opacity:1},{queue:false,duration:t_speed,easing:'swing'});
                t_items.eq(t_index_old).animate({opacity:0},{queue:false,duration:t_speed,easing:'swing'});
            }
            var t_play = function(){
                t_interval = setInterval(t_interval_function,t_interval_time);
            };
            var t_resume = function(){
                clearInterval(t_interval);
                clearTimeout(t_timeout);
                t_timeout = setTimeout(function(){
                    t_interval_function();
                    t_play();
                },t_timeout_time);
            };
            var t_stop = function(){
                clearInterval(t_interval);
                clearTimeout(t_timeout);
            };
            t_items.not('.testimonial_active').css({opacity:0});
            t_play();
            t_items.hover(function(){
                t_stop();
            },function(){
                t_resume();
            });
        }
    });
};

})( jQuery );