<div class="flashSessionMsg">
    {{ flashSession.output() }}
</div>
<div class="col-lg-6 col-md-8 col-sm-8" style="margin-top: 10%;">
    <div class="offset1 span5">
        <label class="control-label"><h2>Sign in</h2></label>

        <form role="form" class="form-horizontal" method="POST" action="/authenticate/sign-in">
            <fieldset>
                <div class="form-group">
                    <div class="col-lg-10">
                        <label for="email" class="control-label">Email</label>
                        {{ signInForm.render("email") }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10">
                        <label for="password" class="control-label">Password</label>

                        {{ signInForm.render("password") }}

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<div class="col-lg-6 col-md-8 col-sm-8" style="margin-top: 10%;">
    <div class="offset1 span5">
        <label class="control-label"><h2>Sign up</h2></label>

        <form role="form" class="form-horizontal" method="POST" action="/authenticate/sign-up">
            <div class="form-group">

                <div class="col-lg-10">
                    <label class="control-label">Email:</label>
                    {{ signUpForm.render("email") }}
                </div>
                <div class="col-lg-10">
                    <label class="control-label">Username:</label>
                    {{ signUpForm.render("username") }}
                </div>
                <div class="col-lg-10">
                    <label class="control-label">Password:</label>
                    {{ signUpForm.render("password") }}
                </div>

                <div class="col-lg-10">
                    <br/>

                    <p><input class="btn btn-primary" role="button" type="submit" name="signup"
                              value="Sign up"></p>
                </div>
            </div>
        </form>
    </div>
</div>