
<div class="container">
    <div class="center">        
        <h2>Drop Your Message</h2>
        <p class="lead">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div> 
    <div class="row contact-wrap"> 
        <div style="display: none" class="status alert alert-success"></div>
        <form action="sendemail.php" method="post" name="contact-form" class="contact-form" id="main-contact-form">
            <div class="col-sm-5 col-sm-offset-1">
                <div class="form-group">
                    <label>Name *</label>
                    <input type="text" required="required" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" required="required" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="number" class="form-control">
                </div>
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" class="form-control">
                </div>                        
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <label>Subject *</label>
                    <input type="text" required="required" class="form-control" name="subject">
                </div>
                <div class="form-group">
                    <label>Message *</label>
                    <textarea rows="8" class="form-control" required="required" id="message" name="message"></textarea>
                </div>                        
                <div class="form-group">
                    <button class="btn btn-primary btn-lg" name="submit" type="submit">Submit Message</button>
                </div>
            </div>
        </form> 
    </div><!--/.row-->
</div>