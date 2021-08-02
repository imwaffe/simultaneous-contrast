<style>
  #userDetailsModal form {
    width:80%;
    margin-top:20px;
    margin-left: auto;
    margin-right: auto;
  }

  #userDetailsModal .form-group.row {
    margin-top:20px;
    margin-top:20px;
  }

  #userDetailsModal label span.label-description {
    display: inline-block;
    font-size:0.8em;
    font-weight: 100;
  }
</style>

<div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModal" aria-hidden="true">
    <div class="modal-dialog dark-modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="userDetailsModal"><?php t("user_details", "tell_something_about_you") ?></h3>
          </div>
          <div class="modal-body">
            <?php t("user_details", "before_start_need_information") ?>
            <form id="userDetailsForm">
              <div class="form-group row">
                <label for="user_nickname" class="col-form-label">
                  <?php t("global", "nickname") ?>:<br>
                  <span class="label-description">
                    <?php t("user_details", "ask_nickname") ?>
                  </span>
                </label>
                  <input type="text" class="form-control" id="user_nickname" placeholder="eg: juliet-reds" required>
              </div>
              <div class="form-group row">
                <label for="user_gender" class="col-form-label">
                  <?php t("global", "gender") ?>:<br>
                  <span class="label-description">
                    <?php t("user_details", "select_gender") ?>
                  </span>
                </label>
                <select class="form-control" id="user_gender" required>
                  <option value="" selected disabled hidden><?php t("global", "select_dropdown") ?></option>
                  <option value="female"><?php t("global", "female") ?></option>
                  <option value="male"><?php t("global", "male") ?></option>
                  <option value="intersex"><?php t("global", "intersex") ?></option>
                </select>
              </div>
              <div class="form-group row">
                <label for="user_color" class="col-form-label">
                  <?php t("user_details", "q_work_with_color") ?><br>
                  <span class="label-description">
                    <?php t("user_details", "q_work_with_color_explain") ?><br>
                    <?php t("user_details", "q_work_with_color_examples") ?>
                  </span>
                </label>
                <select class="form-control" id="user_color" required>
                  <option value="" selected disabled hidden><?php t("global", "select_dropdown") ?></option>
                  <option value="yes"><?php t("global", "yes") ?></option>
                  <option value="no"><?php t("global", "no") ?></option>
                </select>
              </div>
              <div class="form-group row">
                <label for="user_colorblind" class="col-form-label">
                  <?php t("user_details", "q_problem_with_color") ?><br>
                  <span class="label-description">
                    <?php t("user_details", "q_problem_with_color_explain") ?>
                  </span>
                </label>
                <select class="form-control" id="user_colorblind" required>
                  <option value="" selected disabled hidden><?php t("global", "select_dropdown") ?></option>
                  <option value="yes"><?php t("global", "yes") ?></option>
                  <option value="no"><?php t("global", "no") ?></option>
                  <option value="unsure"><?php t("global", "unsure") ?></option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button id="saveUserDetails" type="button" class="btn btn-primary"><?php t("global", "submit_and_continue") ?></button>
          </div>
        </div>
    </div>
</div>