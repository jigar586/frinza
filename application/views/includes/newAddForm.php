<?php 
if(isset($user)) {
   ?>
  <fieldset>
    <legend>Billing Address</legend>
    <input type="hidden" name="billing[address_id]" id="billing_address_id">
    <ul>
      <li>
        <div class="customer-name">
          <div class="input-box name-firstname">
            <label for="billing_firstname">First Name <span class="required">*</span> </label>
            <br>
            <input type="text" id="billing_firstname" name="billing[firstname]" value="<?= $user[0]->first_name ?>" title="First Name" class="input-text required-entry">
          </div>
          <div class="input-box name-lastname">
            <label for="billing_lastname"> Last Name <span class="required">*</span> </label>
            <br>
            <input type="text" id="billing_lastname" name="billing[lastname]" value="<?= $user[0]->last_name ?>" title="Last Name" class="input-text required-entry">
          </div>
        </div>
      </li>
      <li>
        <label>Email <span class="required">*</span></label>
        <br>
        <input type="text" title="User Email" name="billing[email]" id="billing_email" placeholder="Enter Email ID" value="<?= $user[0]->user_email ?>" class="input-text required-entry">
      </li>
      <li>
        <label>Address <span class="required">*</span></label>
        <br>
        <input type="text" title="Street Address" name="billing[street1]" id="billing" placeholder="Enter Address" class="input-text required-entry">
      </li>
      <li>
        <input type="text" title="Street Address 2" name="billing[street2]" id="billing2" value="" class="input-text">
      </li>
      <li>
        <div class="input-box">
          <label for="billing_city">City <span class="required">*</span></label>
          <br>
          <input type="text" title="City" name="billing[city]" placeholder="Name of City" class="input-text required-entry" id="billing_city">
        </div>
        <div class="input-box">
          <label for="billing_region">State <span class="required">*</span></label>
          <br>
          <select id="billing_region_id" name="billing[region_id]" title="State/Province" class="validate-select form-control">
            <option value="">Select State</option>
            <?php
              if (count($states) != 0) { 
                  foreach ($states as $stt) {
                ?>
                <option value="<?= $stt->state_id ?>"><?= $stt->state_name ?></option>
            <?php  }}
             ?>
          </select>
        </div>
      </li>
      <li>
        <div class="input-box">
          <label for="billing_postcode">Zip/Postal Code <span class="required">*</span></label>
          <br>
          <input type="number" title="Zip/Postal Code Should be in Numbers only" name="billing[postcode]" id="billing_postcode" placeholder="Zip Code" class="input-text inpNumber validate-zip-international required-entry" pattern="[0-9]{6}" min="100000" max="999999" maxlength="6">
        </div>
        
      <!-- </li>
      <li> -->
        <div class="input-box">
          <label for="billing_telephone">Telephone <span class="required">*</span></label>
          <br>
          <input type="tel" name="billing[telephone]" placeholder="Enter Contact No" title="Telephone Should be in Numbers only" value="<?= $user[0]->user_contact ?>" class="input-text inpNumber required-entry" pattern="[0-9]{10}" min="1000000000" max="9999999999"  maxlength="10" id="billing_telephone">
        </div>
        
      </li>
     
    </ul>
  </fieldset>
<?php }elseif (isset($BillAdd)) {
?>
  <fieldset>
    <legend>Billing Address</legend>
    <input type="hidden" name="billing[address_id]" id="billing_address_id" value="<?= $BillAdd[0]->address_id ?>">
    <ul>
      <li>
        <div class="customer-name">
          <div class="input-box name-firstname">
            <label for="billing_firstname">First Name <span class="required">*</span> </label>
            <br>
            <input type="text" id="billing_firstname" name="billing[firstname]" value="<?= $BillAdd[0]->name ?>" title="First Name" class="input-text required-entry">
          </div>
          <div class="input-box name-lastname">
            <label for="billing_lastname"> Last Name <span class="required">*</span> </label>
            <br>
            <input type="text" id="billing_lastname" name="billing[lastname]" value="<?= $BillAdd[0]->last_name ?>" title="Last Name" class="input-text required-entry">
          </div>
        </div>
      </li>
      <li>
        <label>Email <span class="required">*</span></label>
        <br>
        <input type="text" title="User Email" name="billing[email]" id="billing_email" placeholder="Enter Email ID" value="<?= $BillAdd[0]->email ?>" class="input-text required-entry">
      </li>
      <li>
        <label>Address <span class="required">*</span></label>
        <br>
        <input type="text" title="Street Address" name="billing[street1]" id="billing" placeholder="Enter Address" class="input-text required-entry" value="<?= $BillAdd[0]->address_1 ?>">
      </li>
      <li>
        <input type="text" title="Street Address 2" name="billing[street2]" id="billing2" class="input-text" value="<?= $BillAdd[0]->address_2 ?>">
      </li>
      <li>
        <div class="input-box">
          <label for="billing_city">City <span class="required">*</span></label>
          <br>
          <input type="text" title="City" name="billing[city]" placeholder="Name of City" class="input-text required-entry" id="billing_city" value="<?= $BillAdd[0]->city ?>">
        </div>
        <div class="input-box">
          <label for="billing_region">State <span class="required">*</span></label>
          <br>
          <select id="billing_region_id" name="billing[region_id]" title="State/Province" class="form-control validate-select" value='<?= $BillAdd[0]->state ?>'>
            <option value="">Select State</option>
            <?php
              if (count($states) != 0) { 
                  foreach ($states as $stt) {
                    if ($BillAdd[0]->state == $stt->state_id) { ?>
                      <option value="<?= $stt->state_id ?>" selected = 'selected'><?= $stt->state_name ?></option>
                <?php    }else{
                ?>
                <option value="<?= $stt->state_id ?>"><?= $stt->state_name ?></option>
            <?php  }}}
             ?>
          </select>
        </div>
      </li>
      <li>
        <div class="input-box">
          <label for="billing_postcode">Zip/Postal Code <span class="required">*</span></label>
          <br>
          <input type="number" title="Zip/Postal Code Should be Numbers Only" name="billing[postcode]" id="billing_postcode" placeholder="Zip Code" min="100000" max="999999"  pattern="[0-9]{6}" maxlength="6" class="input-text validate-zip-international inpNumber required-entry" value="<?= $BillAdd[0]->pin_code ?>">
        </div>
        
      <!-- </li>
      <li> -->
        <div class="input-box">
          <label for="billing_telephone">Telephone <span class="required">*</span></label>
          <br>
          <input type="tel" pattern="\d*" name="billing[telephone]" maxlength="10" placeholder="Enter Contact No" title="Telephone Should be Numbers Only" value="<?= $BillAdd[0]->contact ?>" pattern="[0-9]{10}" class="input-text inpNumber required-entry" id="billing_telephone">
        </div>
        
      </li>
     
    </ul>
  </fieldset>
<?php }elseif (isset($ShipAdd)) { ?>
  <fieldset>
      <legend>Shipping Address</legend>
      <input type="hidden" name="Shipping[address_id]" id="Shipping_address_id" value="<?= $ShipAdd[0]->address_id ?>">
      <ul>
        <li>
          <div class="customer-name">
            <div class="input-box name-firstname">
              <label for="Shipping_firstname">First Name <span class="required">*</span> </label>
              <br>
              <input type="text" id="Shipping_firstname" name="Shipping[firstname]" value="<?= $ShipAdd[0]->name ?>" title="First Name" class="input-text required-entry">
            </div>
            <div class="input-box name-lastname">
              <label for="Shipping_lastname"> Last Name <span class="required">*</span> </label>
              <br>
              <input type="text" id="Shipping_lastname" name="Shipping[lastname]" value="<?= $ShipAdd[0]->last_name ?>" title="Last Name" class="input-text required-entry">
            </div>
          </div>
        </li>
        <li>
          <label>Email <span class="required">*</span></label>
          <br>
          <input type="text" title="User Email" name="Shipping[email]" id="Shipping_email" placeholder="Enter Email ID" value="<?= $ShipAdd[0]->email ?>" class="input-text required-entry">
        </li>
        <li>
          <label>Address <span class="required">*</span></label>
          <br>
          <input type="text" title="Street Address" name="Shipping[street1]" id="Shipping" placeholder="Enter Address" class="input-text required-entry" value="<?= $ShipAdd[0]->address_1 ?>">
        </li>
        <li>
          <input type="text" title="Street Address 2" name="Shipping[street2]" id="Shipping2" value="<?= $ShipAdd[0]->address_2 ?>" class="input-text">
        </li>
        <li>
          <div class="input-box">
            <label for="Shipping_city">City <span class="required">*</span></label>
            <br>
            <input type="text" title="City" name="Shipping[city]" placeholder="Name of City" class="input-text required-entry" id="Shipping_city" value="<?= $ShipAdd[0]->city ?>">
          </div>
          <div class="input-box">
            <label for="Shipping_region">State <span class="required">*</span></label>
            <br>
            <select id="Shipping_region_id" name="Shipping[region_id]" title="State/Province" class="validate-select" value='<?= $ShipAdd[0]->state ?>'>
              <option value="">Select State</option>
              <?php
                if (count($states) != 0) { 
                    foreach ($states as $stt) {
                      if ($ShipAdd[0]->state == $stt->state_id) {
                  ?>
                  <option value="<?= $stt->state_id ?>" selected><?= $stt->state_name ?></option>
                <?php }else{ ?>
                   <option value="<?= $stt->state_id ?>"><?= $stt->state_name ?></option>
              <?php  }}}
               ?>
            </select>
          </div>
        </li>
        <li>
          <div class="input-box">
            <label for="Shipping_postcode">Zip/Postal Code <span class="required">*</span></label>
            <br>
            <input type="number" title="Zip/Postal Code" name="Shipping[postcode]" id="Shipping_postcode" min="100000" max="999999" pattern="[0-9]{6}" maxlength="6" placeholder="Zip Code Should be Numbers only" value="<?=  $ShipAdd[0]->pin_code ?>" class="input-text inpNumber validate-zip-international required-entry">
          </div>
          
        <!-- </li>
        <li> -->
          <div class="input-box">
            <label for="Shipping_telephone">Telephone <span class="required">*</span></label>
            <br>
            <input type="tel" name="Shipping[telephone]" placeholder="Enter Contact No" title="Telephone Should be Numbers only" value="<?=  $ShipAdd[0]->contact ?>" pattern="[0-9]{10}" maxlength="10"  class="input-text inpNumber required-entry" id="Shipping_telephone">
          </div>
          
        </li>
       
      </ul>
    </fieldset>
  <?php }else{ ?>
    <fieldset>
      <legend>Shipping Address</legend>
      <input type="hidden" name="Shipping[address_id]" id="Shipping_address_id">
      <ul>
        <li>
          <div class="customer-name">
            <div class="input-box name-firstname">
              <label for="Shipping_firstname">First Name <span class="required">*</span> </label>
              <br>
              <input type="text" id="Shipping_firstname" name="Shipping[firstname]" value="<?= $user1[0]->first_name ?>" title="First Name" class="input-text required-entry">
            </div>
            <div class="input-box name-lastname">
              <label for="Shipping_lastname"> Last Name <span class="required">*</span> </label>
              <br>
              <input type="text" id="Shipping_lastname" name="Shipping[lastname]" value="<?= $user1[0]->last_name ?>" title="Last Name" class="input-text required-entry">
            </div>
          </div>
        </li>
        <li>
          <label>Email <span class="required">*</span></label>
          <br>
          <input type="text" title="User Email" name="Shipping[email]" id="Shipping_email" placeholder="Enter Email ID" value="<?= $user1[0]->user_email ?>" class="input-text required-entry">
        </li>
        <li>
          <label>Address <span class="required">*</span></label>
          <br>
          <input type="text" title="Street Address" name="Shipping[street1]" id="Shipping" placeholder="Enter Address" class="input-text required-entry">
        </li>
        <li>
          <input type="text" title="Street Address 2" name="Shipping[street2]" id="Shipping2" value="" class="input-text">
        </li>
        <li>
          <div class="input-box">
            <label for="Shipping_city">City <span class="required">*</span></label>
            <br>
            <input type="text" title="City" name="Shipping[city]" placeholder="Name of City" class="input-text required-entry" id="Shipping_city">
          </div>
          <div class="input-box">
            <label for="Shipping_region">State <span class="required">*</span></label>
            <br>
            <select id="Shipping_region_id" name="Shipping[region_id]" title="State/Province" class="validate-select">
              <option value="">Select State</option>
              <?php
                if (count($states) != 0) { 
                    foreach ($states as $stt) {
                  ?>
                  <option value="<?= $stt->state_id ?>"><?= $stt->state_name ?></option>
              <?php  }}
               ?>
            </select>
          </div>
        </li>
        <li>
          <div class="input-box">
            <label for="Shipping_postcode">Zip/Postal Code <span class="required">*</span></label>
            <br>
            <input type="number" title="Zip/Postal Code" min="100000" max="999999" name="Shipping[postcode]" id="Shipping_postcode" pattern="[0-9]{6}" maxlength="6"  placeholder="Zip Code Should be Numbers Only" class="input-text inpNumber validate-zip-international required-entry">
          </div>
          
        <!-- </li>
        <li> -->
          <div class="input-box">
            <label for="Shipping_telephone">Telephone <span class="required">*</span></label>
            <br>
            <input type="tel" name="Shipping[telephone]" min="1000000000" max="9999999999" placeholder="Enter Contact No" title="Telephone Should be Numbers Only" pattern="[0-9]{10}" maxlength="10" value="<?= $user1[0]->user_contact ?>" class="input-text inpNumber required-entry" id="Shipping_telephone">
          </div>
          
        </li>
       
      </ul>
    </fieldset>
  <?php } ?>