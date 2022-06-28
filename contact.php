<?php

session_start();
include("connections.php");
?>
<?php include 'header/header.php';?>
<!-- Contact Information form -->
<section id="contact-form">
        <div class="container1">
            <h1>Contact Us</h1>
            <p>
                Please fill out the form below to contact us
            </p>
            <form action="process.php">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>
           

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message"> </textarea>
                </div>

                <button type="submit" class="btn">Submit</button>

            </form>
        </div>
    </section>

    <!-- Contact of our company -->
    <section id="contact-info">
        <div class="container1">
            <div class="box" >  
                <h3> location</h3>
                <p> 1839, CDA Avenue (Rahima Center - 8th Flr). East Nasirabad., CDA Ave, Chattogram</p>
            </div>
            <div class="box">
                <h3>Phone Number</h3>
                <p>123456789</p>
            </div>
            <div class="box">
                <h3>Email Address</h3>
                <a href="mailto:monirulcr2325@gmail.com">Coursemanagement@gmail.com</a>
            </div>
            
            
        </div>

    </section>

    
<!-- footer -->
<?php include 'footer.php'; ?>   
</body>
</html>