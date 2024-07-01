<?php
// Add this to your theme's footer.php or via wp_footer hook in functions.php
function my_custom_modal() {
    ?>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
             <div class="form_info">
                <div class="logo">
                    <img src="<?php echo site_url( ).'/wp-content/uploads/2023/10/cropped-FENIX-PEOPLE-LOGO-NEW-v3-197x77-1.png'?>" alt="">
                </div>
                <h1>BOOKKEPPING ACCOUNTING AND BUSINESS MANAGEMENT SUPPORT YOU NEED !</h1>
                <p>Accounts Payable|Accounts Receivable|BookKeeping|Accounting|Payroll|Business Solutions </p>
             </div>
            <p><?php echo do_shortcode('[forminator_form id="839"]')?></p>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'my_custom_modal');

function my_custom_modal_script() {
    ?>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 999999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
            /* padding-top: 60px; */
/*            display: flex;*/
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 0 auto;
            padding: 30px;
            width: 100%;
            max-width: 550px;
            max-height: 100%;
            border-radius: 8px;
            overflow: auto;
            position: relative;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            right: 10px;
            top: 10px;
            height: 30px;
            width: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        #shadow-host-companion {
            padding: 0;
        }
        .modal .forminator-row-last,
        .modal .forminator-ui {
            margin-bottom: 0 !important;
        }
        .modal p:empty {
            margin: 0 !important;
        }
        .form_info,
        .logo {
            text-align: center;
        }
        .logo img {
            margin: 0 auto;
        }
        .form_info h1 {
            margin: 10px 0;
            font-size: 25px;
            line-height: 30px;
        }
        .form_info {
            max-width: 430px;
            margin: 0 auto;
        }
        .logo {
            margin-bottom: 30px;
        }
        .modal .forminator-button {
            border-radius: 4px !important;
            color: #ffffff;
            background-color: #313fa0 !important;
            width: 100% !important;
            box-shadow: none !important;
        }
        .modal .forminator-button:hover {
            background-color: #f73e19 !important;
            box-shadow: none !important;
        }
        .modal .forminator-row-last .forminator-field {
            text-align: center;
        }

        #myModal .forminator-input {
            background-color: transparent !important;
        }
        #myModal .forminator-is_hover .forminator-input,
        #myModal .forminator-ui .forminator-input:focus,
        .forminator-ui#forminator-module-841.forminator-design--default
            .forminator-is_hover
            .forminator-input {
            border-color: #313fa0 !important;
        }
        @media only screen and (max-width: 767px) {
            .form_info h1 {
            font-size: 18px;
            line-height: 25px;
            }
            .modal-content {
            padding: 20px;
            width: 90%;
            }
        }
        </style>
        <script>
        // Utility function to get a cookie by name
        function getCookie(name) {
            let cookieArr = document.cookie.split(";");

            for (let i = 0; i < cookieArr.length; i++) {
            let cookiePair = cookieArr[i].split("=");

            if (name == cookiePair[0].trim()) {
                return decodeURIComponent(cookiePair[1]);
            }
            }

            return null;
        }

        // Utility function to set a cookie
        function setCookie(name, value, days) {
            let date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            let expires = "expires=" + date.toUTCString();
            document.cookie =
            name + "=" + encodeURIComponent(value) + ";" + expires + ";path=/";
        }

        document.addEventListener("DOMContentLoaded", function () {
            const cookieName = "modalShown";
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];
            // Check if the cookie exists
            if (!getCookie(cookieName)) {
            // Show the modal
            //  alert("Ada");

            modal.style.display = "flex";

            // Set the cookie to prevent showing the modal again
            }
            // Cookie expires in 30 days

            // Close the modal when the user clicks on the close button (x)
            span.onclick = function () {
            modal.style.display = "none";
             setCookie(cookieName, "true", 30);
            };

            // Close the modal when the user clicks anywhere outside of the modal
            window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
                setCookie(cookieName, "true", 30);
            }
            };
        });
        jQuery(document).on("forminator:form:submit:success", function (e, formData) {
            const cookieName1 = "modalShown";
            var modal = document.getElementById("myModal");
            // Replace `forminator-form-1` with your actual Forminator form ID

            // Your custom JavaScript code here
            console.log("Form submitted successfully!");
            setCookie(cookieName1, "true", 30);
            setTimeout(function () {
            modal.style.display = "none";
            }, 3000);
        });
        </script>

    <?php
}
add_action('wp_footer', 'my_custom_modal_script');

