$(document).ready(function(){
	$(".stock-update-btn").click(function(){
		$(".stock-update-btn-menu").collapse('toggle');
	});
	$(".homepage-design-btn").click(function(){
		$(".homepage-design-collapse").collapse('toggle');
	});
});
// dynamic page request
$(document).ready(function(){
	var active_link = $(".active").attr("access-link");
	dynamic_request(active_link);
	$(".collapse-item").each(function(){
		$(this).click(function(){
			var request_url = $(this).attr("access-link");
			dynamic_request(request_url);
		});
	});
});

function dynamic_request(request_url){
	var request_link = request_url;
	$.ajax({
		type : "POST",
		url : "dynamic_pages/"+request_link,
		xhr : function(){
			var request = new XMLHttpRequest();
			request.onprogress = function(e){
			var persentage = Math.floor((e.loaded*100)/e.total)
			var loader = '<center><button class="btn btn-danger" style="font-size: 30px"><i class="fa fa-circle-o-notch fa-spin"></i>Loading<span>'+persentage+'%</span></button></center>';
			$(".page").html(loader);
			}
			return request;
		},
		beforeSend : function(){
			var loader = '<center><button class="btn btn-danger" style="font-size: 30px"><i class="fa fa-circle-o-notch fa-spin"></i>Loading<span></span></button></center>';
			$(".page").html(loader);
		},
		success : function (response){
				if(request_link == "delivery_area_design.php")
				{
					delivery_area();
				}
				if(request_link == "branding_design.php")
				{
					branding_information();
				}
				if(request_link == "header_showcase_design.php")
				{
					header_showcase();
				}
				if(request_link == "category_showcase_design.php")
				{
					category_showcase();
				}

 				
				else if(request_link == "create_category_design.php")
				{
					category_list();
				}
				else if(request_link == "create_products_design.php")
				{
					//products code

					$(document).ready(function(){
						$(".create-products-form").submit(function(e){

							var option = $(".brands-name option");
							var i;
							var c_name = "";
							for(i=0;i<option.length;i++)
							{
								if(option[i].innerHTML == $(".brands-name").val())
								{
									c_name = $(option[i]).attr("c-name");
								}
							}
							
							e.preventDefault();
							if($(".brands-name").val() != "Choose brand")
					{
						$.ajax({
							type : "POST",
							url : "php/create_products.php?c_name="+c_name,
							data : new FormData(this),
							contentType : false,
							processData : false,
							cache : false,
							xhr : function(){
								var request = new XMLHttpRequest();
								request.upload.onprogress = function(e){
								var persentage =	Math.floor((e.loaded*100)/e.total);
								$(".create-products-progress .progress-bar").css({
									width : persentage+"%"
								});
								$(".create-products-progress .progress-bar").html(persentage);

								}
								return request;
							},
							beforeSend : function(){
								$(".create-products-progress").removeClass("d-none");
							},
							success : function(response){
								if(response.trim() == "success")
								{
									$(".create-products-progress").addClass("d-none");
									$(".create-products-progress .progress-bar").css({
									width : '0%'
								});
									$(".create-products-form").trigger("reset");
								}
								else
								{
									alert(response);
								}
							}
						});
					}
						});
					});
					
				}
				$(".page").html(response);
				$(".add-field-btn").click(function(){
					var placeholder = $(".input:first").attr("placeholder");
				var input = document.createElement("INPUT");
				input.type = "text";
				input.className = "input form-control mb-3";
				input.placeholder = placeholder;
				input.required = "required";
				input.style.background = "#f9f9f9";
				input.style.border = "none";
				$(".add-field-area").append(input);
				});
				$(".create-btn").click(function(e){
					e.preventDefault();
					var input = [];
					var input_length = $(".input").length;
					var i;
					for(i=0;i<input_length;i++)
					{
						input[i] = document.getElementsByClassName("input")[i].value;
					}
					var object = JSON.stringify(input);
					$.ajax({
						type : "POST",
						url : "php/create_category.php",
						data : {
							json_data : object
						},
						cache : false,
						beforeSend : function(){
							$(".create-category-loader").removeClass("d-none");
						},
						success : function(response){
							$(".create-category-loader").addClass("d-none");
							if(response.trim() == "insert success"){
								category_list();
								var notice = document.createElement("DIV");
								notice.className = "alert alert-success";
								notice.innerHTML = "<b>Success !</b>";
								$(".create-category-notice").html(notice);
								setTimeout(function(){
									$(".create-category-notice").html("");
									$(".create-category-form").trigger("reset");
								},3000);
							}
							else
							{
								var notice = document.createElement("DIV");
								notice.className = "alert alert-warning";
								notice.innerHTML = "<b>"+response+"</b>";
								$(".create-category-notice").html(notice);
								setTimeout(function(){
									$(".create-category-notice").html("");
									$(".create-category-form").trigger("reset");
								},3000);	
							}
						}
					});
				});
				//add brand btn 
				$(".add-brand-btn").click(function(){
					var placeholder = $(".brand-input:first").attr("placeholder");
				var input = document.createElement("INPUT");
				input.type = "text";
				input.className = "brand-input form-control mb-3";
				input.placeholder = placeholder;
				input.required = "required";
				input.style.background = "#f9f9f9";
				input.style.border = "none";
				$(".brand-field-area").append(input);
				});

				//create brand 

				$(".create-brand-btn").click(function(e){
					e.preventDefault();
					var category = $(".brand-category").val();
					if (category == "Choose category") 
					{
								var notice = document.createElement("DIV");
								notice.className = "alert alert-warning";
								notice.innerHTML = "<b>Chose a category</b>";
								$(".brand-field-notice").html(notice);
								setTimeout(function(){
									$(".brand-field-notice").html("");
									$(".create-brand-form").trigger("reset");
								},3000);
					}
					else
					{
					var input = [];
					var input_length = $(".brand-input").length;
					var i;
					for(i=0;i<input_length;i++)
					{
						input[i] = document.getElementsByClassName("brand-input")[i].value;
					}
					var object = JSON.stringify(input);
					$.ajax({
						type : "POST",
						url : "php/create_brand.php",
						data : {
							json_data : object,
							category : category
						},
						cache : false,
						beforeSend : function(){
							$(".create-brand-loader").removeClass("d-none");
						},
						success : function(response){
							$(".create-brand-loader").addClass("d-none");
							if(response.trim() == "insert success"){
		
								var notice = document.createElement("DIV");
								notice.className = "alert alert-success";
								notice.innerHTML = "<b>Success !</b>";
								$(".brand-field-notice").html(notice);
								setTimeout(function(){
									$(".brand-field-notice").html("");
									$(".create-brand-form").trigger("reset");
								},3000);
							}
							else
							{
								var notice = document.createElement("DIV");
								notice.className = "alert alert-warning";
								notice.innerHTML = "<b>"+response+"</b>";
								$(".brand-field-notice").html(notice);
								setTimeout(function(){
									$(".brand-field-notice").html("");
									$(".create-brand-form").trigger("reset");
								},3000);	
							}
						}
					});
				}
				});


				// display brands 

				$(document).ready(function(){
					$(".display-brand").on("change", function(){
						var selected_category = $(this).val();
						var all_option = $(this).html().replace("<option>"+selected_category+"</option>").replace("<option>Choose category</option>");
						$.ajax({
							type : "POST",
							url : "php/display_brands.php",
							data : {
								category : selected_category
							},
							cache : false,
							beforeSend : function(){
								$(".display-brand-loder").removeClass("d-none");
							},
							success : function(response){
								if(response.trim() != "<b>No brands has been created yet in this category</b>")
								{
									$(".display-brand-loder").addClass("d-none");
									var table = document.createElement("table");
									table.width = "100%";
									table.border = "1";
									table.className = "text-center";
									var json_data = JSON.parse(response);
									var i;
									var top_tr = document.createElement("tr");
									var th_cat = document.createElement("td");
									th_cat.height = "40";
									th_cat.innerHTML = "CATEGORY";
									th_cat.className = "bg-danger text-light";
									var th_brands = document.createElement("td");
									th_brands.height = "40";
									th_brands.innerHTML = "BRAND NAME";
									th_brands.className = "bg-danger text-light";
									var th_edit = document.createElement("td");
									th_edit.height = "40";
									th_edit.innerHTML = "EDIT";
									th_edit.className = "bg-danger text-light";
									var th_delete = document.createElement("td");
									th_delete.height = "40";
									th_delete.innerHTML = "DELETE";
									th_delete.className = "bg-danger text-light";
									top_tr.append(th_cat);
									top_tr.append(th_brands);
									top_tr.append(th_edit);
									top_tr.append(th_delete);
									table.append(top_tr);
									for(i=0;i<json_data.length;i++)
									{
										var tr = document.createElement("tr");
										var td_cat = document.createElement("td");
										var td_brands = document.createElement("td");
										var td_edit = document.createElement("td");
										var td_delete = document.createElement("td");
										td_cat.innerHTML = "<select disabled='disabled' class='border p-2 w-75 dynamic-c-name'><option>"+json_data[i].category_name+"</option>"+all_option+"</select>";
										td_brands.innerHTML = json_data[i].brands;
										td_edit.innerHTML = "<i class='fa fa-edit brand-edit' c-name='"+json_data[i].category_name+"' b-name='"+json_data[i].brands+"'></i><i class='fa fa-save brand-save d-none'></i><i class='fa fa-spinner fa-spin d-none edit-brand-loader'></i>";
										td_delete.innerHTML = "<i class='fa fa-trash brand-delete' c-name='"+json_data[i].category_name+"' b-name='"+json_data[i].brands+"'></i><i class='fa fa-spinner fa-spin d-none delete-brand-loader'></i>";
										table.append(tr);
										tr.append(td_cat);
										tr.append(td_brands);
										tr.append(td_edit);
										tr.append(td_delete);
										$(".brand-list-area").html(table);

										// delete brand

										$(".brand-delete").each(function(){
											$(this).click(function(){
												var delete_icon = this;
												var c_name = $(this).attr("c-name");
												var b_name = $(this).attr("b-name");
												var td = this.parentElement;
												var delete_brands_icon = td.getElementsByClassName("brand-delete")
												loader = td.getElementsByClassName("delete-brand-loader");

												$.ajax({
													type : "POST",
													url : "php/delete_brands.php",
													data : {
														c_name : c_name,
														b_name : b_name
													},
													cache : false,
													beforeSend : function(){
														$(loader).removeClass("d-none");
														$(delete_brands_icon).addClass("d-none");
													},
													success : function(response){
														$(loader).addClass("d-none");
														$(delete_brands_icon).removeClass("d-none");
														if(response.trim() == "<b>Brand delete success</b>")
														{
															var row = delete_icon.parentElement.parentElement;
															row.remove();
														}
														else
														{
															alert(response);
														}
													}
												});
											});
										});

										// edit brand

										$(".brand-edit").each(function(){
											$(this).click(function(){
												$(this).addClass("d-none");
												var edit_icon = $(this);
												var row = this.parentElement.parentElement;
												var td = row.getElementsByTagName("TD");
												var select_tag = td[0].getElementsByClassName("dynamic-c-name")[0];
												select_tag.disabled = false;
												td[1].contentEditable = true;
												td[1].focus();
												var delete_icon = td[3].getElementsByClassName("brand-delete")[0];
												var save_icon = td[2].getElementsByClassName("brand-save")[0];
												$(save_icon).removeClass("d-none");
												var previous_c_name = $(this).attr("c-name");
												var previous_b_name = $(this).attr("b-name");
												
												save_icon.onclick = function(){
													var c_name = select_tag.value;
													var b_name = td[1].innerHTML.trim();
													$.ajax({
														type : "POST",
														url : "php/edit_brands.php",
														data : {
															previous_c_name : previous_c_name,
															previous_b_name : previous_b_name,
															c_name : c_name,
															b_name : b_name
														},
														cache : false,
														success : function(response){
															if(response.trim() == "<b>Success</b>"){
																$(save_icon).addClass("d-none");
																$(edit_icon).removeClass("d-none");
																td[1].contentEditable = false;
																select_tag.disabled = true;
																$(save_icon).attr("c-name",c_name);
																$(edit_icon).attr("c-name",c_name);
																$(save_icon).attr("b-name",b_name);
																$(edit_icon).attr("b-name",b_name);
																$(delete_icon).attr("c-name",c_name);
																$(delete_icon).attr("b-name",b_name);
															}
														}
													});
												}
											});
										});
									}
							    }
							else
							{
								$(".brand-list-area").html(response);
								$(".display-brand-loder").addClass("d-none");
							}
						}
						});
					});
				});
				
		}
	});
}

// active tab

$(document).ready(function(){
	$(".collapse-item").each(function(){
		$(this).click(function(){
			for(i=0;i<$(".collapse-item").length;i++)
			{
				$(".collapse-item").removeClass("active");
			}
			$(this).addClass("active");
		});
	});
});

// category list request

$(document).ready(function(){
	category_list();
});


function category_list(){
	$.ajax({
		type : "POST",
		url : "php/category_list.php",
		success : function(response)
		{
			var category_list = JSON.parse(response);
			var i;
			for(i=0;i<category_list.length;i++)
			{
				var id = category_list[i].id;
				var name = category_list[i].category_name;
				var ul = document.createElement("UL");
				ul.className  = "list-group";
				var li = document.createElement("LI");
				li.className  = "list-group-item mb-3 border-0";
				ul.append(li);
				var div = document.createElement("DIV");
				div.className = "btn-group";
				li.append(div);
				var id_btn = document.createElement("BUTTON");
				id_btn.innerHTML = id;
				id_btn.className = "btn btn-danger id";
				div.append(id_btn);

				var name_btn = document.createElement("BUTTON");
				name_btn.innerHTML = name;
				name_btn.className = "btn btn-dark name";
				div.append(name_btn);

				var edit_btn = document.createElement("BUTTON");
				edit_btn.innerHTML = "<i class='fa fa-edit edit-icon'></i><i class='fa fa-save save-icon d-none'></i><i class='fa fa-spinner fa-spin name-loader d-none'></i>";
				edit_btn.className = "btn btn-info";
				div.append(edit_btn);

				var delete_btn = document.createElement("BUTTON");
				delete_btn.innerHTML = "<i class='fa fa-trash delete-icon'></i>";
				delete_btn.className = "btn btn-danger";
				div.append(delete_btn);
				$(".category-area").append(ul);
				// edit icon code
				edit_btn.onclick = function(){
					var parent = this.parentElement;
					var cat_name = parent.getElementsByClassName("name")[0];
					cat_name.contentEditable = true;
					cat_name.focus();
					var id = parent.getElementsByClassName("id")[0];
					var save_icon = parent.getElementsByClassName("save-icon")[0];
					$(save_icon).removeClass("d-none");
					var loader = parent.getElementsByClassName("name-loader")[0];
					var edit_icon = parent.getElementsByClassName("edit-icon")[0];
					$(edit_icon).addClass("d-none");

					$(save_icon).click(function(){
						var changed_name = cat_name.innerHTML.trim();
						var name_id = id.innerHTML.trim();
						$.ajax({
							type : "POST",
							url : "php/edit_category_name.php",
							data : {
								id : name_id,
								name : changed_name
							},
							beforeSend : function(){
								$(loader).removeClass("d-none");
								$(save_icon).addClass("d-none");
							},
							success : function(response){
								if(response.trim() == "success")
								{
							    cat_name.contentEditable = false;
								$(save_icon).addClass("d-none");
								$(edit_icon).removeClass("d-none");
								$(loader).addClass("d-none");
								}
								else
								{
									alert(response);
								cat_name.contentEditable = false;
								$(save_icon).addClass("d-none");
								$(edit_icon).removeClass("d-none");
								$(loader).addClass("d-none");	
								}
								

							}
						});
					});
					
				}
				// delete icon code

				delete_btn.onclick = function(){
					var parent = this.parentElement;
					var id = parent.getElementsByClassName("id")[0].innerHTML.trim();
					$.ajax({
						type : "POST",
						url : "php/delete_category_name.php",
						data : {
							id : id
						},
						cache : false,
						success : function(response){
							if(response.trim() == "success")
							{
								parent.parentElement.remove();
							}
							else
							{
								alert(response);
							}
						}
					});
				}
			}
		}
	});
}

//branding information

function branding_information(){
	
					$(document).ready(function(){
						$("#term").on("input",function(){
							var length = $(this).val().length;
							$(".term-count").html(length);
							;
						});
					});
					$(document).ready(function(){
						$("#address").on("input",function(){
							var length = $(this).val().length;
							$(".address").html(length);
							;
						});
					});
					$(document).ready(function(){
						$("#about-us").on("input",function(){
							var length = $(this).val().length;
							$(".about").html(length);
							;
						});
					});
					$(document).ready(function(){
						$("#address").on("input",function(){
							var length = $(this).val().length;
							$(".address").html(length);
							;
						});
					});
					$(document).ready(function(){
						$("#privacy-policy").on("input",function(){
							var length = $(this).val().length;
							$(".privacy").html(length);
							;
						});
					});
					$(document).ready(function(){
						$("#cookies-policy").on("input",function(){
							var length = $(this).val().length;
							$(".cookie").html(length);
							;
						});
					});
					$(document).ready(function(){
						$(".branding-form").submit(function(e){
							e.preventDefault();
							var file = document.querySelector("#brand-logo");
							var file_size;
							if(file.value == "")
							{
								file_size = 0;
							}
							else
							{
								file_size =  file.files[0].size;
							}
							if(200000>file_size)
							{
							$.ajax({
								type :"POST",
								url : "php/branding.php",
								data : new FormData(this),
								processData : false,
								contentType : false,
								cache : false,
								success : function(response){
									document.write(response);
								}
							});
						   }
						   else
						   {
						   	alert("file size too large kindely Upload less then 200kb");
						   }
						});
					});

					//branding detail control
					$(document).ready(function(){
						$.ajax({
							type : "POST",
							url :"php/check_branding_table.php",
							success : function(response){
								var all_data = JSON.parse(response.trim());
								$("#brand-name").val(all_data[0].brand_name);
								$("#domain-name").val(all_data[0].domain_name);
								$("#email").val(all_data[0].email);
								$(".facebook").val(all_data[0].facebook_url);
								$(".twitter").val(all_data[0].twitter_url);
								$("#address").val(all_data[0].address);
								$("#phone").val(all_data[0].phone);
								$("#about-us").val(all_data[0].about_us);
								$("#privacy-policy").val(all_data[0].privacy);
								$("#cookies-policy").val(all_data[0].cookies);
								$("#term").val(all_data[0].term);
								$(".branding-form input,.branding-form textarea,.branding-form button").prop("disabled",true);
								$(".branding-edit").click(function(){
									$(".branding-form input,.branding-form textarea,.branding-form button").prop("disabled",false);
								});
							}
						});
					});
				}

// header showcase

function header_showcase()
		{
			
		$(document).ready(function(){
			$(".target").each(function(){
				$(this).click(function(event){
				var element = event.target;
				var in_number = $(element).index();
				sessionStorage.setItem("color_in_number",in_number);
				var i;
				for(i=0;i<$(".target").length;i++)
				{
					$(".target").css({
					border : "",
					boxShdow : "",
					padding : "",
					width : ""
				});
				}
				$(this).css({
					border : "5px solid red",
					boxShdow : "0px 0px 3px grey",
					padding : "2px",
					width : "fit-content"
				});
			});
				$(this).on("dblclick", function(){
					var i;
				for(i=0;i<$(".target").length;i++)
				{
					$(".target").css({
					border : "",
					boxShdow : "",
					padding : "",
					width : ""
				});
				}
				});
			
				$(".color-selector").on("change",function(){
					var color = this.value;
					var in_number = Number(sessionStorage.getItem("color_in_number"));
					var element = document.getElementsByClassName("target")[in_number];
					element.style.color = color;
					
				});
					$(".font-size").on("input",function(){
					var color = this.value;
					var in_number = Number(sessionStorage.getItem("color_in_number"));
					var element = document.getElementsByClassName("target")[in_number];
					element.style.fontSize = color+"%";
					
				});
			});
			$("#title-image").on("change", function(){
				var file = this.files[0];

				if(file.size <200000)
				{
					var url = URL.createObjectURL(file);
					var image = new Image();
					image.src = url;
					image.onload = function(){
						var o_width = image.width;
						var o_height = image.height;
						if(o_height == 978 && o_width == 1920)
						{
							image.style.width = "100%";
							image.style.position = "absolute";
							image.style.top = "0";
							image.style.left = "0";

							$(".showcase-preview").append(image);
						}
						else
						{
							alert("please upload file 1920*978");
						}
					}

				}
				else
				{
					alert("file size to large please upload below 200kb");
				}
			});
		});
		//textarea max length
		$(document).ready(function(){
			$("#title-text").on("input",function(){
				var length = this.value.length;
				$(".showcase-title").html(this.value);
				$(".title-limit").html(length);
			});
		});
		$(document).ready(function(){
			$("#subtitle-text").on("input",function(){
				var length = this.value.length;
				$(".showcase-subtitle").html(this.value);
				$(".subtitle-limit").html(length);
			});
		});
		$(document).ready(function(){
			$(".showcase-form").submit(function(e){
				e.preventDefault();
				var title = document.querySelector(".showcase-title");
				var subtitle = document.querySelector(".showcase-subtitle");
				var file_data = document.querySelector("#title-image").files[0];
				var title_size = "";
				var title_color = "";
				if(title.style.fontSize == "")
				{
					title_size = "300%";
				}
				else
				{
					title_size = title.style.fontSize;
				}
				if(title.style.color == "")
				{
					title_color = "black";
				}
				else
				{
					title_color = title.style.color;
				}
				var subtitle_size = "";
				var subtitle_color = "";
				if(subtitle.style.fontSize == "")
				{
					subtitle_size = "300%";
				}
				else
				{
					subtitle_size = subtitle.style.fontSize;
				}
				if(subtitle.style.color == "")
				{
					subtitle_color = "black";
				}
				else
				{
					subtitle_color = subtitle.style.color;
				}
				var flex_box = document.querySelector(".showcase-preview");
				var h_align = "";
				var v_align = "";
				if(flex_box.style.justifyContent == "")
				{
					h_align = "flex-start";
				}
				else
				{
					h_align = flex_box.style.justifyContent;
				}
				if(flex_box.style.alignItems == "")
				{
					v_align = "flex-start";
				}
				else
				{
					v_align = flex_box.style.alignItems;
				}

				var css_data =  {
					title_color : title_color,
					title_size  : title_size,
					subtitle_color : subtitle_color,
					subtitle_size  : subtitle_size,
					h_align : h_align,
					v_align : v_align,
					title_text : title.innerHTML,
					subtitle_text : subtitle.innerHTML,
					buttons : $(".title-buttons").html().trim(),
					options : $("#edit-title").val().trim()
				}
				var form_data = new FormData();
				form_data.append("file_data", file_data);
				form_data.append("css_data", JSON.stringify(css_data));

				$.ajax({
					type : "POST",
					url : "php/header_showcase.php",
					data : form_data,
					processData : false,
					contentType : false,
					cache : false,
					success : function(response){
						alert(response);
						console.log(response);
					}
				});
			});
		});
		// align code
		$(document).ready(function(){
			$(".alignment").each(function(){
				$(this).click(function(){
					var position = $(this).attr("align-position");
					var value = $(this).attr("align-value");
					if(position == "h")
					{
						$(".showcase-preview").css({
							justifyContent : value
						});
					}
					else if(position == "v")
					{
						$(".showcase-preview").css({
							alignItems : value
						});
					}
				});
			});
		});

		// create btn 
		$(document).ready(function(){
			$(".add-btn").click(function(){
				var button = document.createElement("BUTTON");
				button.className = "btn mr-2 title-btn";
				button.style.backgroundColor = $(".btn-bgcolor").val();
				var a = document.createElement("A");
				a.href = $(".btn-url").val();
				a.innerHTML = $(".btn-name").val();
				a.style.color = $(".btn-textcolor").val();
				a.style.fontSize = $(".btn-size").val();
				button.append(a);
				var title_buttons = document.querySelector(".title-buttons");
				var child_title = title_buttons.getElementsByTagName("BUTTON");
				var button_length = child_title.length;
				if(button_length == "0"  || button_length == "1")
				{
					$(".title-buttons").append(button);
				}
				else
				{
					alert("only 2 buttons are allowed");
				}
			});
		});

		$(document).ready(function(){
			$(".real-preview-btn").click(function(){
				var file = document.querySelector("#title-image").files[0];
			var formdata = new FormData();
			formdata.append("photo",file);
			var flex_box = document.querySelector(".showcase-preview");
				var h_align = "";
				var v_align = "";
				if(flex_box.style.justifyContent == "")
				{
					h_align = "flex-start";
				}
				else
				{
					h_align = flex_box.style.justifyContent;
				}
				if(flex_box.style.alignItems == "")
				{
					v_align = "flex-start";
				}
				else
				{
					v_align = flex_box.style.alignItems;
				}
				var array = [$(".title-box").html().trim(),h_align,v_align];
				formdata.append("data", JSON.stringify(array));

				$.ajax({
					type : "POST",
					url : "php/preview.php",
					data : formdata,
					contentType : false,
					processData : false,
					cache : false,
					success : function(response){
						var page = window.open("about:blank");
						page.document.open();
						page.document.write(response);
						page.document.close();

					}
				});	
			});
			

		});
		//edit title

		$(document).ready(function(){
			var showcase_preview = $(".showcase-preview").html();
			$("#edit-title").on("change", function(){
				if($(this).val() != "Choose title")
				{
					
					$.ajax({
						type : "POST",
						url : "php/edit_title.php",
						data : {
							id : $(this).val()
						},
						success : function(response){
							$(".delete-title").removeClass("d-none");
							$(".delete-title").click(function(){
								$.ajax({
									type : "POST",
									url : "php/delete_title.php",
									data : {
										id : $("#edit-title").val()
									},
									success : function(response){
										if(response.trim() == "success")
										{
											$(".add-showcase-btn").html("Add showcase");
										$(".add-showcase-btn").removeClass("bg-danger");
										$("#title-image").removeAttr("required");
										$(".add-showcase-btn").addClass("bg-primary");
										$(".showcase-form").trigger('reset');
										$(".showcase-preview").html(showcase_preview);
										$(".delete-title").addClass("d-none");
										var op = $("#edit-title option");
										op[0].selected = "selected";
										var i;
										for(i=0;i<op.length;i++)
										{
											if(op[i].value == selected_value)
											{
												op[i].remove();
											}	
										}

										}
										else
										{
											alert(response);
										}
									}
								});
							});
							$(".add-showcase-btn").html("Save edit");
							$(".add-showcase-btn").removeClass("bg-primary");
							$(".add-showcase-btn").addClass("bg-danger");
							var all_data = JSON.parse(response.trim());
							var image = document.createElement("img");
							image.src = all_data[0];
							image.style.width = "100%";
							image.style.position = "absolute";
							image.style.top = "0";
							image.style.left = "0";
							$(".showcase-preview").append(image);
							$(".showcase-title").html(all_data[1]);
							$(".showcase-title").css({
								color : all_data[2],
								fontSize : all_data[3]
							});
							$(".showcase-subtitle").html(all_data[4]);
							$(".showcase-subtitle").css({
								color : all_data[5],
								fontSize : all_data[6]
							});
							$(".title-buttons").html(all_data[9]);
							$("#title-text").html(all_data[1]);
							$("#subtitle-text").html(all_data[4]);

							// edit-btn
							$(".title-btn").each(function(){
								
								$(this).click(function(){
									sessionStorage.setItem("btn_key",$(this).index());
									$(".delete-btn").removeClass("d-none");
									var url = $(this).children().attr("href");
									$(".btn-url").val(url);
									$(".btn-name").val($(this).children().html());

									var color = $(this).css("backgroundColor").replace("rgb(","").replace(")","");
									var rgb = color.split(",");
									var i;
									var color_code = "";
									for(i=0;i<rgb.length;i++)
									{
										var hex_code = Number(rgb[i]).toString(16);
										color_code +=hex_code.length == 1 ?"0"+hex_code : hex_code;
									}

									$(".btn-bgcolor").val("#"+color_code);

									var text_color = $(this).children().css("color").replace("rgb(","").replace(")","");
									var text_rgb = text_color.split(",");
								
									var text_color_code = "";
									for(i=0;i<text_rgb.length;i++)
									{
										var text_hex_code = Number(text_rgb[i]).toString(16);
										text_color_code +=text_hex_code.length == 1 ?"0"+text_hex_code : text_hex_code;
									}
									$(".btn-textcolor").val("#"+text_color_code);
									var btn_size = $(this).children().css("fontSize");
									for(i=0;i<$(".btn-size").children().length;i++)
									{
										var option = $(".btn-size").children();
										if(option[i].value == btn_size)
										{
											option[i].selected = "selected";
										}
									}
								});
							});
							$(".btn-name").on("input",function(){
								var btn_i = sessionStorage.getItem("btn_key");
								var selected_btn = document.getElementsByClassName("title-btn")[btn_i];
								selected_btn.getElementsByTagName("A")[0].innerHTML = this.value;

							});

							$(".btn-bgcolor").on("change",function(){
								var btn_i = sessionStorage.getItem("btn_key");
								var selected_btn = document.getElementsByClassName("title-btn")[btn_i];
								selected_btn.style.backgroundColor = this.value;

							});
							$(".btn-textcolor").on("change",function(){
								var btn_i = sessionStorage.getItem("btn_key");
								var selected_btn = document.getElementsByClassName("title-btn")[btn_i];
								selected_btn.getElementsByTagName("A")[0].style.color = this.value;

							});
							$(".btn-size").on("change",function(){
								var btn_i = sessionStorage.getItem("btn_key");
								var selected_btn = document.getElementsByClassName("title-btn")[btn_i];
								selected_btn.getElementsByTagName("A")[0].style.fontSize = this.value;

							});
							$(".delete-btn").on("click",function(){
								var btn_i = Number(sessionStorage.getItem("btn_key"));
								var selected_btn = document.getElementsByClassName("title-btn")[btn_i];
								selected_btn.remove();
								$(".btn-url,.btn-name").val("");
								$(".btn-color, btn-textcolor").val("#000000");
								var op = $(".btn-size option");
								op[0].selected = "selected";
								$(".delete-btn").addClass("d-none");

							});
						
						}
					});
				}
				else
				{
					$(".add-showcase-btn").html("Add showcase");
					$(".add-showcase-btn").removeClass("bg-danger");
					$(".add-showcase-btn").addClass("bg-primary");
					$(".showcase-form").trigger('reset');
					$(".showcase-preview").html(showcase_preview);
					$(".delete-title").addClass("d-none");
					$("#title-image").attr("required");
				}
			});
		});
		
	}

// category showcase

function category_showcase(){
	$(document).ready(function(){
		$(".upload-icon").each(function(){
			$(this).on("change",function(){
				var upload_icon = this;
				var dummy_pic = upload_icon.parentElement.parentElement.parentElement;
				var input = upload_icon.parentElement.parentElement.getElementsByTagName("input")[1];
				var set_btn = upload_icon.parentElement.parentElement.getElementsByClassName("set-btn")[0];
				dummy_pic = dummy_pic.getElementsByTagName("img")[0];
				var dummy_pic_width = dummy_pic.naturalWidth;
				var dummy_pic_height = dummy_pic.naturalHeight;
				var file = upload_icon.files[0];
				var url = URL.createObjectURL(file);
				var image = new Image();
				image.src = url;
				var uploade_height = "";
				var uploade_width = "";
				image.onload = function(){
					uploade_width = image.width;
					uploade_height = image.height;
						if(dummy_pic_width == uploade_width && dummy_pic_height == uploade_height)
					{
						input.oninput = function(){
							if(this.value.length >= 1)
							{
								set_btn.disabled = false;
								set_btn.onclick = function(){
									var formdata = new FormData();
									formdata.append("pic",file);
									formdata.append("text", input.value);
									formdata.append("dir", $(set_btn).attr("img-dir"));
									$.ajax({
										type : "POST",
										url : "php/category_showcase.php",
										data : formdata,
										processData : false,
										contentType : false,
										cache : false,
										beforeSend : function(){
											set_btn.innerHTML = "Please wait..";
											set_btn.disabled = true;
										},
										success : function(response)
										{
											set_btn.innerHTML = "SET";
											set_btn.disabled = false;
											if(response.trim() == "success")
											{
												dummy_pic.src = url;
												$(upload_icon.parentElement.parentElement).addClass("d-none");
												dummy_pic.ondblclick = function(){
													$(upload_icon.parentElement.parentElement).removeClass("d-none");
												}
											}
										}
									})
								}
							}
							else
							{
								set_btn.disabled = true;
							}
						}
					}
						
					else
					{
						alert("Please upload image "+dummy_pic_width+"/"+dummy_pic_height);
					}
				}

			});
				
				
		});
	});
	$(document).ready(function(){
		var img = $("img");
		var i;
		for(i=0;i<img.length;i++)
		{
			if(img[i].src.indexOf("base64") != -1)
			{	
				var set_btn = img[i].parentElement.getElementsByClassName("set-btn")[0];
				set_btn.disabled = false;
				$(".set-btn").each(function(){
					$(this).click(function(){
						set_btn = this;
					var input = this.parentElement.getElementsByTagName("input");
					var file = input[0].files[0];
					var text = input[1].value;
					var dummy_pic = this.parentElement.parentElement.getElementsByTagName("img")[0];
					var url = dummy_pic.src;
					if(input[0].value != "")
					{
						url = new createObjectURL(input[0].files[0]);
					}

					var formdata = new FormData();
									formdata.append("pic",file);
									formdata.append("text", text);
									formdata.append("dir", $(set_btn).attr("img-dir"));
									$.ajax({
										type : "POST",
										url : "php/category_showcase.php",
										data : formdata,
										processData : false,
										contentType : false,
										cache : false,
										beforeSend : function(){
											set_btn.innerHTML = "Please wait..";
											set_btn.disabled = true;
										},
										success : function(response)
										{
											set_btn.innerHTML = "SET";
											set_btn.disabled = false;
											if(response.trim() == "success")
											{
												dummy_pic.src = url;
												$(set_btn.parentElement).addClass("d-none");
												dummy_pic.ondblclick = function(){
													$(set_btn.parentElement).removeClass("d-none");
												}
											}
										}
									});
					});
				});
				

				}


			}
		
	});
}


// delivery area


		
function delivery_area(){
	// get country and states
		$(document).ready(function(){
			$(".country").on("change", function(){
				$(".state").html('');
				var option = $(".country option");
				var i,j;
				for(i=0;i<option.length;i++)
				{
					if(option[i].innerHTML == $(".country").val())
					{
						var country_id = $(option[i]).attr("country-id");
						$.ajax({
							type : "POST",
							url : "php/get_states.php",
							data : {
								country_id : country_id
							},
							success : function(response){
								var states = JSON.parse(response.trim());
								for(j=0;j<states.length;j++)
								{
									var options = "<option state-id='"+states[j].id+"'>"+(states[j].name)+"</option>";
									$(".state").append(options);
								}
							}
						});
					}
				}
			});
		});

		// get city

				$(document).ready(function(){
			$(".state").on("change", function(){
				$(".city").html('');
				var option = $(".state option");
				var i,j;
				for(i=0;i<option.length;i++)
				{
					if(option[i].innerHTML == $(".state").val())
					{
						var state_id = $(option[i]).attr("state-id");
						$.ajax({
							type : "POST",
							url : "php/get_city.php",
							data : {
								state_id : state_id
							},
							success : function(response){
								var city = JSON.parse(response.trim());
								for(j=0;j<city.length;j++)
								{
									var options = "<option>"+(city[j].name)+"</option>";
									$(".city").append(options);
								}
							}
						});
					}
				}
			});
		});

// get pincode

$(document).ready(function(){
	$(".city").on("change", function(){
		var city = $(".city").val();
		$.ajax({
			type : "GET",
			url : "https://api.postalpincode.in/postoffice/"+city,
			success : function(response){
				
				$(".pincode").val(response[0].PostOffice[0].Pincode);
			}
		});
	});
});
// set area
$(document).ready(function(){
	$(".set-area-form").submit(function(e){
	e.preventDefault();
	$.ajax({
		type : "POST",
		url : "php/set_area.php",
		data : new FormData(this),
		processData : false,
		contentType : false,
		cache : false,
		success : function(response){
			alert(response);
		}
	});
});
});
}


