		<div style="display: none">
			<table>
				<tbody id="fileTemplate">
					<tr id="fileRow">
						<td>
							<input type="text" placeholder="請填寫檔案標題" class="form-control" id="<?php echo $abrv;?>file_title[]" name="<?php echo $abrv;?>file_title[]" aria-required="true" value="" />
						</td>
						<td>
							<div class="fileinput fileinput-new" data-provides="fileinput">
	                            <span class="btn green btn-file">
	                                <span class="fileinput-new"> 請選擇檔案 </span>
	                                <span class="fileinput-exists"> 重選 </span>
	                                <input type="file" id="tmp_file" name="tmp_file">
                                    <input type="hidden" name="tmp_filename[]" id="tmp_filename">
                                    <input type="hidden" name="tmp_file_url[]" id="tmp_file_url">
	                            </span>
	                            <span class="fileinput-filename"></span>
	                        </div>
						</td>
						<td>
							<a id="delFile" class="btn red delete">
	                            <i class="fa fa-trash"></i>
	                            <span> 刪除 </span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>