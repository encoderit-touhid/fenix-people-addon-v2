<?php
// Add this to your theme's footer.php or via wp_footer hook in functions.php
function my_custom_modal() {
    ?>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p><?php echo do_shortcode('[forminator_form id="837"]')?></p>
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
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
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
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        let expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + encodeURIComponent(value) + ";" + expires + ";path=/";
    }

    document.addEventListener("DOMContentLoaded", function() {
        const cookieName = "modalShown";
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        // Check if the cookie exists
        if (!getCookie(cookieName)) {
            // Show the modal
          //  alert("Ada");
           

            modal.style.display = "block";

            // Set the cookie to prevent showing the modal again
           
        }
        // Cookie expires in 30 days

// Close the modal when the user clicks on the close button (x)
        span.onclick = function() {
            modal.style.display = "none";
           // setCookie(cookieName, "true", 30); 
        }

        // Close the modal when the user clicks anywhere outside of the modal
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
               // setCookie(cookieName, "true", 30); 
            }
        }
    });
    jQuery(document).on('forminator:form:submit:success', function(e, formData) {
        const cookieName1 = "modalShown";
        var modal = document.getElementById("myModal");
        // Replace `forminator-form-1` with your actual Forminator form ID
        
            // Your custom JavaScript code here
            console.log('Form submitted successfully!');
            setCookie(cookieName1, "true", 30); 
            setTimeout(function(){
                modal.style.display = "none";
            }, 6000);
    });
      
    
    </script>
    <?php
}
add_action('wp_footer', 'my_custom_modal_script');

