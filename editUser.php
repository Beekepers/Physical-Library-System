<?php
require 'core/init.php';
if (Input::exists()) {
		$users = new UserLogin();
			try {
				$users->update(array(
					'username' => Input::get('username'),
					'group' => 1
				), $_GET['uid']);
				Session::flash('UserUpdated', 'User Info has been successfully updated.');
				Redirect::to('editUser.php?uid=2');
			} catch(Exception $e) {
				$error;
			}
}
?>
                                <?php 
									$users = DB:: getInstance()->query("SELECT * FROM userlogin WHERE id=".$_GET['uid']."");							
									foreach($users->results() as $users){
									?>
									<?php 
									if(Session::exists('UserUpdated')){ 
                                           echo Session::flash('UserUpdated');
									}
									?>
								<form id="editUser" action="" method="post">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3">
											<label class="control-label" for="username"><font color="#EC0003">*</font> Username</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $users->username; ?>">
                                            </div>
                                        </div>
										<div class="col-lg-3 col-md-3">
											<label class="control-label" for="role"><font color="#EC0003">*</font> User Role:</label>
                                            <div class="form-group">
												<select class="form-control" name="role" id="role">
													<option value="">Select Role</option>
													<?php
														$userRole = DB:: getInstance()->query("SELECT * FROM groups");							
														foreach($userRole->results() as $userRole){
														if ($userRole->id == $users->group){
															$selected = 'selected';
														}else{
															$selected = '';;
														}
													?>
													<option value="<?php echo $userRole->id;?>" <?php echo $selected; ?>><?php echo ucwords($userRole->name); ?></option>
													<?php }?>
												</select>
                                            </div>
										
                                        </div>
									</div>
                                    <div class="clearfix"></div><hr />
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-edit fa-fw"></i>&nbsp;Save Edits
                                        </button>
                                    </div>
                                    <br />
                                </form>         
								<?php }?>                 
                           