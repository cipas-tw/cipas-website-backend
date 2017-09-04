		<div style="display: none">
			<table>
				<tbody id="template">
					<tr id="row">
						<td>
							<div class="form-group">
								<label class="control-label col-md-3">日期</label>
								<div class="col-md-9">
									<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" id="<?php echo $abrv;?>note_date[]" name="<?php echo $abrv;?>note_date[]" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3">標題</label>
                                <div class="col-md-9">
									<input type="text" placeholder="請填寫標題" class="form-control" id="<?php echo $abrv;?>note_title[]" name="<?php echo $abrv;?>note_title[]" aria-required="true" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">連結</label>
								<div class="col-md-9">
									<input type="text" placeholder="請填寫連結" class="form-control" id="<?php echo $abrv;?>note_hyperlinks[]" name="<?php echo $abrv;?>note_hyperlinks[]" aria-required="true" value="" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">內文</label>
								<div class="col-md-9">
                                    <textarea class="form-control" id="<?php echo $abrv;?>note_content[]" name="<?php echo $abrv;?>note_content[]"  aria-required="true" rows="6"></textarea>
                                    <div id="<?php echo $abrv;?>note_content[]"></div>
								</div>
							</div>
						</td>
						<td width="10%">
							<a id="delRow" class="btn red delete">
	                            <i class="fa fa-trash"></i>
	                            <span> 刪除 </span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>