<div class="form-group">
    <label>First Name</label>
    <input type="text" name="fname" id="fname" class="form-control" />
</div>
<div class="form-group">
    <label>Last Name</label>
    <input type="text" name="lname" id="lname" class="form-control" />
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text" name="email" id="email" class="form-control" />
</div>
<div class="form-group">
    <label>Phone Number</label>
    <input type="text" name="phone_number" id="phone_number" class="form-control" />
</div>
<div class="form-group">
    <label>Password</label>
    <input type="password" name="password" id="password" class="form-control" />
</div>
<script>
    $(document).ready(function() {

        var fname = localStorage.getItem('fname');
        var lname = localStorage.getItem('lname');
        var email = localStorage.getItem('email');
        var phone_number = localStorage.getItem('phone_number');
        var password = localStorage.getItem('password');

        $('#fname').val(fname);
        $('#lname').val(lname);
        $('#email').val(email);
        $('#phone_number').val(phone_number);
        $('#password').val(password);

    });
</script>