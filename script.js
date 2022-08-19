(function ($) {
    $(document).ready(function () {
        $('.tm-header-gallery').magnificPopup({
            delegate: 'a', // child items selector, by clicking on it popup will open
            type: 'image',
            gallery: { enabled: true }
        });

        /**
         * Function for the services- page, functionality
         */

        $('.tm-tab-content-box').hide();
        $('#tab1C').fadeIn('slow');
        $('#tab1C').show();

        $('.tm-tab-link').click(function () {

            var t = $(this).attr('id');

            $('.tm-tab-link').removeClass('active');
            $(this).addClass('active');

            $('.tm-tab-content-box').hide();
            $('#' + t + 'C').fadeIn('slow');

        });
        /**
         *  Preview uploded files - form trimite problema
        */
        const dt = new DataTransfer();

        $("#problema_files").on('change', function (e) {
            for (var i = 0; i < this.files.length; i++) {
                let fileBloc = $('<span/>', { class: 'file-block' }),
                    fileName = $('<span/>', { class: 'name', text: this.files.item(i).name });
                fileBloc.append('<span class="file-delete"><span>+</span></span>')
                    .append(fileName).append("<img class=' resize'' src='" + URL.createObjectURL(this.files.item(i)) + "'>");
                $("#files-names").append(fileBloc);

            };

            for (let file of this.files) {
                dt.items.add(file);
            }
            $('span.file-delete').click(function () {
                let name = $(this).next('span.name').text();

                $(this).parent().remove();
                for (let i = 0; i < dt.items.length; i++) {
                    if (name === dt.items[i].getAsFile().name) {
                        dt.items.remove(i);
                        continue;
                    }
                }

                document.getElementById('problema_files').files = dt.files;
            });
        });

        /**
         *  Sfârșit-Preview uploded files - form trimite problema
         */


        /**
         * Slick slider for the uploaded image in form trimite problema
         */
        if ($("body").hasClass("single-problema")) {
            $('.post-images').slick({
                arrows: true,
                infinite: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true
            });
        }

        /**
         * jquery validator- validate trimite problema form with jquery
         */

        $("#trimite-problema").validate({
            rules: {
                problema_name: {
                    required: true,
                    regex: true
                },
                problema_last_name: {
                    required: true,
                    regex: true
                },
                problema_mail: {
                    required: true,
                    email: true,
                },
                problema_phone: {
                    required: true,
                    regex: true
                },
                problema_address: {
                    required: true
                },
                problema_term_id: {
                    required: true,
                },
                problema_category: {
                    required: true,
                },
                problema_description: {
                    required: true,
                },
                problema_InputCheckbox: {
                    required: true,
                }

            },
            messages: {
                problema_name: {
                    required: "*Câmpul este obligatoriu!",
                    regex: "*Numele trebuie sa fie format doar din litere!"
                },
                problema_last_name: {
                    required: "*Câmpul este obligatoriu!",
                    regex: "*Prenumele trebuie sa fie format doar din litere!"
                },
                problema_mail: {
                    required: "*Câmpul este obligatoriu",
                    email: "*Adresa de email nu este validă!",
                },
                problema_phone: {
                    required: "*Câmpul este obligatoriu",
                    regex: '*Numarul de telefon nu este valid!',
                },
                problema_address: {
                    required: "*Câmpul este obligatoriu",
                },
                problema_term_id: {
                    required: "*Câmpul este obligatoriu",
                },
                problema_category: {
                    required: "*Câmpul este obligatoriu",
                },
                problema_description: {
                    required: "*Câmpul este obligatoriu",
                },
                problema_InputCheckbox: {
                    required: "*Pentru a continua trebuie să bifați căsuța de acceptare!",
                }
            },
            highlight: function (element) {
                $(element).parent().addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).parent().removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "problema_InputCheckbox") {
                    error.appendTo("#checkbox-error");
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $.validator.addMethod(
            "regex",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
        );

        $("#problema_phone").rules("add", { regex: "^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$" });

        $("#problema_name").rules("add", { regex: "^[a-zA-Z-' ]*$" });
        $("#problema_last_name").rules("add", { regex: "^[a-zA-Z-' ]*$" });


        $("#problema_button").click(function () {  // capture the click
            if ($("#trimite-problema").valid()) {   // test for validity

                $('#loading').show();
                setTimeout(function () {
                    $('.#loading').hide();
                }, 10000);

            } else {

            }
        });

        /**
         * Like/Dislike post function ajax
         */
        function like_dislike(apreciation, post_id, selector_name) {
            jQuery.ajax({
                type: "post",
                url: myAjax.ajaxurl,
                data: {
                    action: apreciation,
                    post_id: post_id,
                    apreciation
                },
                success: function (response) {

                    let data = JSON.parse(response);

                    if (data.type === "success") {

                        $("#" + apreciation).text('(' + data.count + ')');

                        if ($("." + selector_name).hasClass('active')) {
                            $("." + selector_name).removeClass('active');
                        }
                    }
                }
            });
        }

        /**
         * Like/Dislike post ajax action
         */
        $(".user_like, .user_dislike").click(function (e) {
            e.preventDefault();
            let post_id = $(this).attr("data-id");
            let appreciation = $(this).attr("appreciation");
            let other_appreciation = $(this).attr("other-appreciation");
            let other_selector;
            if ($(this).hasClass('user_like')) {
                selector = 'user_like';
                other_selector = 'user_dislike';
            } else {
                selector = "user_dislike"
                other_selector = 'user_like';
            }

            jQuery.ajax({
                type: "post",
                url: myAjax.ajaxurl,
                data: {
                    action: appreciation,
                    post_id,
                    appreciation
                },
                success: function (response) {

                    let data = JSON.parse(response);
                    
                    if(data.logged == false) {
                        $('#myModal').modal('show');    
                    }

                    if (data.type === "success") {

                        $("#" + appreciation).text('(' + data.count + ')');

                        if ($("." + selector).hasClass('active')) {
                            $("." + selector).removeClass('active');
                        } else {
                            $("." + selector).addClass('active');
                        }
                        
                        if (data.change == true) {
                            like_dislike(other_appreciation, post_id, other_selector);
                        }
                    }
                }
            });
        });

    /**
         * User favorite post
         */
         $(".user_favorite").click(function (e) {
            e.preventDefault();
            let post_id = $(this).attr("data-id");
            
            jQuery.ajax({
                type: "post",
                url: myAjax.ajaxurl,
                data: {
                    action: 'user_favorite_post',
                    post_id
                },
                success: function (response) {
                    let data = JSON.parse(response);
                    
                    if(data.logged == false) {
                        $('#myModal').modal('show');    
                    }
                    if (data.type === "success") {
                        $(".counter_fav").text('(' + data.count + ')');
                        if ($(".user_favorite").hasClass('active')) {
                            $(".user_favorite").removeClass('active');
                        } else {
                            $(".user_favorite").addClass('active');
                        }
                    }
                }
            });
        });

    });
})(jQuery);

