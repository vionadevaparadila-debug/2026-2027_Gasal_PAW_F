<form action="" method="POST">
        <h2>Register</h2>
        <fieldset>
            <legend>Person Details</legend>

            <div class="field">
                <label for="surname">Surname</label>
                <input type="text" name="surname" size="31" />
            </div>

            <div class="field">
                <label for="email">Email address</label>
                <input type="text" name="email" size="31" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>"/>
            </div>

            <div class="field">
                <label for="passwd">Password</label>
                <input type="password" name="passwd" size="31" value="<?php if(isset($_POST['passwd'])){echo $_POST['passwd'];} ?>" />
            </div>

            <div class="field">
                <label for="address">Street Address</label>
                <textarea name="address" rows="3" cols="22"><?php if(isset($_POST['address'])){echo $_POST['address'];} ?></textarea>
            </div>

            <div class="field">
                <label for="state">State</label>
                <select name="state">
                    <option value="-1" <?php if(isset($_POST['state']) ) { if($_POST['state'] == -1){echo 'selected';}} ?>>[choose your state]</option>
                    <option value="1" <?php if(isset($_POST['state']) ) { if($_POST['state'] == 1){echo 'selected';}} ?>>Australian Capital Territory</option >
                    <option value="2" <?php if(isset($_POST['state']) ) { if($_POST['state'] == 2){echo 'selected';}} ?>>Queensland</option>
                    <option value="3" <?php if(isset($_POST['state']) ) { if($_POST['state'] == 3){echo 'selected';}} ?>>Victoria</option>
                    <option value="4" <?php if(isset($_POST['state']) ) { if($_POST['state'] == 4){echo 'selected';}} ?>>New South Wales</option>
                    <option value="5" <?php if(isset($_POST['state']) ) { if($_POST['state'] == 5){echo 'selected';}} ?>>Tasmania</option>
                    <option value="6" <?php if(isset($_POST['state']) ) { if($_POST['state'] == 6){echo 'selected';}} ?>>South Australia</option>
                    <option value="7" <?php if(isset($_POST['state']) ) { if($_POST['state'] == 7){echo 'selected';}} ?>>Western Australia</option>
                    <option value="8" <?php if(isset($_POST['state']) ) { if($_POST['state'] == 8){echo 'selected';}} ?>>Northern Territory</option>
                </select>
            </div>

            <div class="field">
                <input type="hidden" name="country" value="Australia" />
            </div>

            <div class="field">
                <label for="sex">Gender</label>
                <input type="radio" name="sex" value="male" <?php if(isset($_POST['sex']) ) { if($_POST['sex'] == 'male'){echo 'checked';}} ?> />Male
                <input type="radio" name="sex" value="female" <?php if(isset($_POST['sex']) ) { if($_POST['sex'] == 'female'){echo 'checked';}} ?> />Female
            </div>

            <div class="field">
                <label for="vegetarian">Vegetarian?</label>
                <input type="checkbox" name="vegetarian" <?php if(isset($_POST['vegetarian']) ) { if($_POST['vegetarian'] == 'on'){echo 'checked';}} ?> />
            </div>

            <div class="field">
                <label>&nbsp;</label>
                <input type="submit" value="Submit" name="submit" /><input type="reset" value="Reset" name="reset" />
            </div>

        </fieldset>
    </form>