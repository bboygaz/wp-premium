( function( $ ) {
    $(document).ready(function(){
        
        ///////////////////////////////////////
        //Détermine la hauteur de l'application
        ///////////////////////////////////////
        
        bodyHeight = $(window).height();
        headerHeight = $('#site-header').outerHeight();
        wrapperHeight = (bodyHeight - headerHeight) - 45;
        
        $('#main-wrapper').height(wrapperHeight);
        
        ////////////
        //Buger menu
        ////////////
        
        $(document).on('click', '#burger', burgerMenu);
        
        burgerStatus = 'closed';
        
        function burgerMenu(){
            
            if (burgerStatus === 'closed') {
                
                $('#ajax-wrapper').velocity({
                    opacity: .25
                }, 200, 'ease');
                
                $('#sidebar').velocity({
                    translateX: 0
                }, 200, 'ease');
                burgerStatus = "open";
                
            } else {
                
                $('#ajax-wrapper').velocity({
                    opacity: 1
                }, 200, 'ease');
                
                $('#sidebar').velocity({
                    translateX: "-100%"
                }, 200, 'ease');
                burgerStatus = "closed";
                
            }
            
        }
        
        //////////////
        //Vimeo Player
        //////////////
        
        $(document).on('click', '#video-trigger', insertPlayer);
        
        function insertPlayer(){
            
            $('#slider-wrapper').velocity({
                translateX: '-50%'
            }, 200, 'ease', function(){
                vimeoPlayer.play();
            });
            
            playerState = 'on';
            
        }
        
        ////////////
        //Chapitrage
        ////////////
        
        $(document).on('click', '.chapitre', jump_to_chapitre);
        
        function jump_to_chapitre() {
            jump = $(this).data('cue');
            
            insertPlayer();
            vimeoPlayer.setCurrentTime(jump);
        }
        
        ///////////////////
        //Current menu item
        ///////////////////
        
        function currentMenuItem(path) {
            
            $('#header-nav li').removeClass('current-menu-item');
            
            path = path.split('/');
            console.log(path);
            pathLength = path.length
            console.log(pathLength);
            
            if (pathLength === 3) {
                $('.nav-home').addClass('current-menu-item');
            } else if (pathLength === 5 ) {
                category = path[3];
                $('#header-nav li[class^="nav-' + category + '"]').addClass('current-menu-item');
            } else if (pathLength === 6) {
                category = path[4];
                $('#header-nav li[class^="nav-' + category + '"]').addClass('current-menu-item');
            } else if (pathLength === 4) {
                category = $('#titre-section').data('cat');
                $('#header-nav li[class^="nav-' + category + '"]').addClass('current-menu-item');
            }
            
        }
        
        currentMenuItem(window.location.pathname);
        
        /////////////////
        //Navigation Ajax
        /////////////////
        
        // j'écoute les clic de tous les liens, sauf de l'admin bar
        $( document ).on( 'click', 'a[href^="http://localhost/wordpress-premium/"]:not(.ab-item)', do_ajax_request );
        
        // lors d'un clic, j'exécute une fonction qui prend le lien en paramètre
        function do_ajax_request( e ) {
            e.preventDefault();
            var url = $( this ).attr( 'href' );
            history.pushState({key : 'value'}, 'titre', url);
            $('#header-nav li').removeClass('current-menu-item');
            
            $(document).ajaxStart(function(){
                
                $('#progress-bar').velocity({
                    width: '10%'
                }, 200, 'ease');
                
            });
            
            $(document).ajaxSend(function(){
                
                $('#ajax-wrapper').velocity({
                    translateX: '-100%'
                }, 200, 'ease');
                
                $('#progress-bar').velocity({
                    width: '50%'
                }, 200, 'ease');
                
            });
            
            $(document).ajaxComplete(function(){       
                
                
                $('#progress-bar').velocity({
                    width: '100%'
                }, 200, 'ease', function(){
                    
                    $('#ajax-wrapper').velocity({
                        translateX: 0
                    }, 200, 'ease');
                    
                });
                
            });
            
            perform_ajax_request( url );
        }
        
        // je fais une requête ajax vers le lien, en poussant BAWXMLHttpRequest dans les headers
        function perform_ajax_request( url ) {
            
            $.ajax({
                url    : url,
                type   : 'POST',
                headers: {
                    'X-Requested-With':'BAWXMLHttpRequest'
                }
            }).done( function( data ) {
                
                $('#ajax-wrapper').html(data);
                currentMenuItem(document.location.pathname);
                test = $('#titre-section').data('cat');
                
            }).error( function() {
                // Error
                alert( 'Impossible de mettre à jour le contenu' );
            });
        }
        
        window.onpopstate = function(event){
            perform_ajax_request(document.location.pathname);
            currentMenuItem(document.location.pathname);
        }        
        
    });
} )( jQuery );