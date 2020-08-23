

// add to cart code
function add_to_cart(){
$(document).ready(function(){
	$(".cart-btn").each(function(){
		$(this).click(function(){
			var all_cookie = document.cookie.split(';');
			var i;
			var temp_cookie = [];
			for(i=0;i<all_cookie.length;i++)
			{
				var cookie = all_cookie[i].split('=');
				if(cookie[0].trim() != '_au_')
				{
					temp_cookie[i] = cookie[0].trim(); 
				}
				else
				{
					temp_cookie = "mached";
				}
			}
			if(temp_cookie == "mached")
			{
				var product_id = $(this).attr("product-id");
				var product_title = $(this).attr("product-title");
				var product_pic = $(this).attr("product-pic");
				var product_brand = $(this).attr("product-brand");
				var product_price = $(this).attr("product-price");
				$.ajax({
					type : "POST",
					url : "http://localhost/shop/pages/php/cart.php",
					data : {
						product_id : product_id,
						product_title : product_title,
						product_pic : product_pic,
						product_brand : product_brand,
						product_price : product_price
					},
					success : function(response)
					{
						if(response.trim() == "success"){
						if($(".cart-notification").prop("nodeName") != undefined)
						{
							var no = Number($(".cart-notification span").html().trim());
							no++;
							$(".cart-notification span").html(no);
						}
						else
						{
							 var div = document.createElement("DIV");
							 div.style.position = "absolute";
							 div.style.color = "white";
							 div.style.backgroundColor = "red";
							 div.style.width = "25px";
							 div.style.height = "25px";
							 div.style.borderRadius = "50%";
							 div.style.top = "-10px";
							 div.style.left = "25px";
							 div.style.fontWeight = "bold";
							 div.style.zIndex = "1000";
							 div.className = "cart-notification";
							 var span = document.createElement("SPAN");
							 span.innerHTML = "1";
							 $(div).append(span);
							 $(".cart-link").append(div);

						}
					}
					else
					{
						alert(response);
					}
				}
				});
			}
			else
			{
				alert("login faild");
			}
		});
	});
});
}

add_to_cart();
// remove cart

$(document).ready(function(){
	$(".delete-cart-btn").each(function(){
		$(this).click(function(){
			var btn = this;
			var pro_id = $(this).attr("product-id");
			var id = $(this).attr("id");
			$.ajax({
				type : "POST",
				url : "../../pages/php/remove_cart.php",
				data : {
					pro_id : pro_id,
					id  : id
				},
				success : function(response){
					if(response.trim() == "success")
					{
						var cart_box = btn.parentElement.parentElement.parentElement;
						cart_box.remove();
					}
					else
					{
						alert(response);
					}
				}
			});
		});
	});
});


// buy btn code 
function buy_btn_code(){
$(document).ready(function(){
	$(".buy-btn").each(function(){
		$(this).click(function(){
			var product_id = $(this).attr("product-id");
			window.location = "http://localhost/shop/buy_now/"+btoa(product_id);

		});
	});
});
}
buy_btn_code();
// purchase btn code

$(document).ready(function(){
	$(".purchase-btn").click(function(){
		var pay_mode = $("input[name='pay-mode']:checked").val();
		if(pay_mode)
		{	
			var id = $(this).attr("product-id").trim();
			var title = $(this).attr("product-title").trim();
			var brand = $(this).attr("product-brand").trim();
			var price = $(this).attr("product-price").trim();
			var qnt = $(".quantity").val().trim();
			if(pay_mode == "online")
			{
				window.location = "http://localhost/shop/pay_online/"+btoa(id)+"/"+btoa(title)+"/"+btoa(brand)+"/"+btoa(price)+"/"+btoa(qnt);
			}
			else
			{
				window.location = "../../pay/purchase_entry.php?id="+id+"&title="+title+"&brand="+brand+"&amount="+price+"&qnt="+qnt+"&payment_mode=cod";	
			}


		}
		else
		{
			alert("Please choose a payment mode !");
		}

	});
});

// postal code api

$(document).ready(function(){
	$(".pincode-btn").click(function(){
		var pin = $(".pincode-field").val();
		$.ajax({
			type : "POST",
			url : "check_pincode.php",
			data : {
				pincode : pin
			},
			success : function(response){
				$(".pincode-notice").html(response);
			}
		});
	});
});

// stock control

$(document).ready(function(){
	$(".quantity").on("input", function(){
		var stocks = Number($(".stocks").html());
		if($(this).val()>stocks)
		{
			alert("negative stocks");
			$(this).val('1');
		}
	});
});


//product preview


$(document).ready(function(){
	$(".thumb-pic").each(function(){
		$(this).click(function(){
			var src = $(this).attr("src");
			$(".preview").attr("src", src);
			$(".preview").addClass("animated zoomIn");
			setTimeout(function(){
				$(".preview").removeClass("animated zoomIn");
			},1000);
		});
	});
});

// filter product by brand

$(document).ready(function(){
	$(".filter-btn").each(function(){
		$(this).click(function(){
			$(".filter-btn").each(function(){
				$(".filter-btn").removeClass("btn-primary px-3 rounded-sm");
			});
			$(this).addClass("btn-primary px-3 rounded-sm");
			var cat_name = $(this).attr("cat-name");
			var brand_name = $(this).attr("brand-name");
			$.ajax({
				type : "POST",
				url : "http://localhost/shop/pages/php/filter_product.php",
				data : {
					cat_name : cat_name,
					brand_name : brand_name
				},
				beforeSend : function(){
					$(".product-result").html("loading...");
				},
				success : function(response){
					$(".product-result").html("");
					var all_data = JSON.parse(response.trim());
					var i;
					if(all_data == 0)
					{
						$(".product-result").html("<h2><i class='fa fa-shopping-cart'></i> Empty ! stocks</h2>");
					}
					else
					{
						for(i=0;i<all_data.length;i++)
						{
							var div = document.createElement("DIV");
							div.className = "text-center border shadow-sm p-3 mb-4";
							var img = document.createElement("IMG");
							img.src = "http://localhost/shop/"+all_data[i].thumb_path;
							img.width = "250";
							img.height = "316";


							// brand
							var brand_span = document.createElement("SPAN");
							brand_span.innerHTML = "<br>"+all_data[i].brands;
							brand_span.className = "text-uppercase font-weight-bold";

							// title
							var title_span = document.createElement("SPAN");
							title_span.innerHTML = "<br>"+all_data[i].title;
							title_span.className = "text-uppercase";

							// price
							var price_span = document.createElement("SPAN");
							price_span.innerHTML = "<br><i class='fa fa-rupee'></i> "+all_data[i].price+"<br>";
							
							// add cart btn 

							var cart_btn = document.createElement("BUTTON");
							cart_btn.innerHTML = "<i class='fa fa-shopping-cart'></i> ADD TO CART";
							cart_btn.className = "btn btn-danger cart-btn mt-3 mr-3";
							$(cart_btn).attr("product-id", all_data[i].id);
							$(cart_btn).attr("product-title", all_data[i].title);
							$(cart_btn).attr("product-price", all_data[i].price);
							$(cart_btn).attr("product-pic", all_data[i].thumb_path);
							$(cart_btn).attr("product-brand", all_data[i].brands);
							// buy btn

							var buy_btn = document.createElement("BUTTON");
							buy_btn.innerHTML = "BUY NOW";
							buy_btn.className = "btn btn-primary buy-btn mt-3 mr-3";
							$(buy_btn).attr("product-id", all_data[i].id);
							$(buy_btn).attr("product-title", all_data[i].title);
							$(buy_btn).attr("product-price", all_data[i].price);
							$(buy_btn).attr("product-pic", all_data[i].thumb_path);

							$(div).append(img);
							$(div).append(brand_span);
							$(div).append(title_span);
							$(div).append(price_span);
							$(div).append(cart_btn);
							$(div).append(buy_btn);
							$(".product-result").append(div);
						}

						add_to_cart();
						buy_btn_code();

					}
				}
			});
		});
	});
});

// filter active

$(document).ready(function(){
	var filter_btn = $(".filter-btn");
	filter_btn[0].click();
});

// filter by price 

$(document).ready(function(){
	$(".price-filter-btn").click(function(){
		var cat_name = $(this).attr("cat-name");
		var min = $(".min-price").val();
		var max = $(".max-price").val();
		$.ajax({
			type : "POST",
			url : "filter_by_price.php",
			data : {
				min : min,
				max : max,
				cat_name : cat_name
			},
			beforeSend : function(){
				$(".product-result").html("loading...");
			},
			success : function(response)
			{
				
					$(".product-result").html("");
					var all_data = JSON.parse(response.trim());
					var i;
					if(all_data == 0)
					{
						$(".product-result").html("<h2><i class='fa fa-shopping-cart'></i> Empty ! stocks</h2>");
					}
					else
					{
						for(i=0;i<all_data.length;i++)
						{
							var div = document.createElement("DIV");
							div.className = "text-center border shadow-sm p-3 mb-4";
							var img = document.createElement("IMG");
							img.src = "http://localhost/shop/"+all_data[i].thumb_path;
							img.width = "250";
							img.height = "316";


							// brand
							var brand_span = document.createElement("SPAN");
							brand_span.innerHTML = "<br>"+all_data[i].brands;
							brand_span.className = "text-uppercase font-weight-bold";

							// title
							var title_span = document.createElement("SPAN");
							title_span.innerHTML = "<br>"+all_data[i].title;
							title_span.className = "text-uppercase";

							// price
							var price_span = document.createElement("SPAN");
							price_span.innerHTML = "<br><i class='fa fa-rupee'></i> "+all_data[i].price+"<br>";
							
							// add cart btn 

							var cart_btn = document.createElement("BUTTON");
							cart_btn.innerHTML = "<i class='fa fa-shopping-cart'></i> ADD TO CART";
							cart_btn.className = "btn btn-danger cart-btn mt-3 mr-3";
							$(cart_btn).attr("product-id", all_data[i].id);
							$(cart_btn).attr("product-title", all_data[i].title);
							$(cart_btn).attr("product-price", all_data[i].price);
							$(cart_btn).attr("product-pic", all_data[i].thumb_path);
							$(cart_btn).attr("product-brand", all_data[i].brands);
							// buy btn

							var buy_btn = document.createElement("BUTTON");
							buy_btn.innerHTML = "BUY NOW";
							buy_btn.className = "btn btn-primary buy-btn mt-3 mr-3";
							$(buy_btn).attr("product-id", all_data[i].id);
							$(buy_btn).attr("product-title", all_data[i].title);
							$(buy_btn).attr("product-price", all_data[i].price);
							$(buy_btn).attr("product-pic", all_data[i].thumb_path);

							$(div).append(img);
							$(div).append(brand_span);
							$(div).append(title_span);
							$(div).append(price_span);
							$(div).append(cart_btn);
							$(div).append(buy_btn);
							$(".product-result").append(div);
						}

						add_to_cart();
						buy_btn_code();

					}
			}
		});
	});
});


// edit personal profile

$(document).ready(function(){
	$(".personal-form").submit(function(e){
		e.preventDefault();
		$.ajax({
			type : "POST",
			url : "personal_information.php",
			data : new FormData(this),
			processData : false,
			contentType : false,
			cache : false,
			beforeSend : function(){
				$(".update-btn").html("please wait..");
			},
			success : function(response)
			{
				$(".update-btn").html("UPDATE");
				alert(response);
			}
		});
	});
});

// change password code

$(document).ready(function(){
	$(".privacy-form").submit(function(e){
		e.preventDefault();
		if($("#newpassword").val() == $("#re-enter-password").val())
		{
			$.ajax({
			type : "POST",
			url : "change_password.php",
			data : new FormData(this),
			processData : false,
			contentType : false,
			cache : false,
			beforeSend : function(){
				$(".change-password").html("please wait..");
			},
			success : function(response)
			{
				$(".change-password").html("UPDATE");
				alert(response);
			}
		});
		}
		else
		{
			alert("new password and re-enterd password must be same");
		}
	});
});

// rate btn


$(document).ready(function(){
	$(".star").each(function(){
		$(this).click(function(){
			$(".star-btn").removeClass("d-none");
			var product_id = $(".star-btn").attr("product-id");
			var index = $(this).attr("index");
			var star = $(".star");
			index++;
			var i;
			for(i=0;i<5;i++)
			{
				$(star[i]).removeClass("fa fa-star text-warning");
				$(star[i]).addClass("fa fa-star-o text-warning");
				if(i<index)
				{
					$(star[i]).removeClass("fa fa-star-o text-warning");
					$(star[i]).addClass("fa fa-star text-warning");
				}
			}

			$(".star-btn").click(function(){

				if($("#comment").val() != "")
				{
					if($("#picture").val() != "")
					{
						
						
						var picture = document.querySelector("#picture").files[0];
						var formdata = new FormData();
						formdata.append("picture",picture);
						formdata.append("comment", $("#comment").val());
						formdata.append("index",index);
						formdata.append("product_id",product_id);
						alert(product_id);
						$.ajax({
							type : "POST",
							url : "rateing.php",
							data : formdata,
							processData : false,
							contentType : false,
							cache : false,
							success : function(response)
							{
								if(response.trim() == "success")
								{
								$(".star-btn").addClass("d-none");
								$(".comment-box").addClass("d-none");
								$(".picture-box").addClass("d-none");
								$(".comment-msg").html("comment posted");
								$(".comment-msg").addClass("alert-success w-50");
								setTimeout(function(){
									$(".comment-msg").html($("#comment").val());
									$(".comment-msg").removeClass("alert-success w-50");
									$(".comment-header").html("Your rating");
								}, 2000);

								}
								else
								{
									alert(response);
								}
							}
						});
					}
					else
					{
						alert("please upload a picture");
					}
				}
				else
				{
					alert("write somthing in comment");
				}
				
			});
		});
	});
});



// short by

$(document).ready(function(){
	$(".short-by").on("change", function(){
		var cat_name = "";
		var brand_name = "";
		$(".filter-btn").each(function(){
			if($(this).attr("class").indexOf("btn-primary") != -1)
			{
				cat_name = $(this).attr("cat-name");
				brand_name = $(this).attr("brand-name");

			}
		});
		var short_by = $(this).val();
		$.ajax({
			type : "POST",
			url : "short_products.php",
			data : {
				cat_name : cat_name,
				brand_name : brand_name,
				short_by : short_by
			},
			beforeSend : function(){
				$(".product-result").html("loading...");
			},
			success : function(response){

				
					$(".product-result").html("");
					var all_data = JSON.parse(response.trim());
					var i;
					if(all_data == 0)
					{
						$(".product-result").html("<h2><i class='fa fa-shopping-cart'></i> Empty ! stocks</h2>");
					}
					else
					{
						for(i=0;i<all_data.length;i++)
						{
							var div = document.createElement("DIV");
							div.className = "text-center border shadow-sm p-3 mb-4";
							var img = document.createElement("IMG");
							img.src = "../../"+all_data[i].thumb_path;
							img.width = "250";
							img.height = "316";


							// brand
							var brand_span = document.createElement("SPAN");
							brand_span.innerHTML = "<br>"+all_data[i].brands;
							brand_span.className = "text-uppercase font-weight-bold";

							// title
							var title_span = document.createElement("SPAN");
							title_span.innerHTML = "<br>"+all_data[i].title;
							title_span.className = "text-uppercase";

							// price
							var price_span = document.createElement("SPAN");
							price_span.innerHTML = "<br><i class='fa fa-rupee'></i> "+all_data[i].price+"<br>";
							
							// add cart btn 

							var cart_btn = document.createElement("BUTTON");
							cart_btn.innerHTML = "<i class='fa fa-shopping-cart'></i> ADD TO CART";
							cart_btn.className = "btn btn-danger cart-btn mt-3 mr-3";
							$(cart_btn).attr("product-id", all_data[i].id);
							$(cart_btn).attr("product-title", all_data[i].title);
							$(cart_btn).attr("product-price", all_data[i].price);
							$(cart_btn).attr("product-pic", all_data[i].thumb_path);
							$(cart_btn).attr("product-brand", all_data[i].brands);
							// buy btn

							var buy_btn = document.createElement("BUTTON");
							buy_btn.innerHTML = "BUY NOW";
							buy_btn.className = "btn btn-primary buy-btn mt-3 mr-3";
							$(buy_btn).attr("product-id", all_data[i].id);
							$(buy_btn).attr("product-title", all_data[i].title);
							$(buy_btn).attr("product-price", all_data[i].price);
							$(buy_btn).attr("product-pic", all_data[i].thumb_path);

							$(div).append(img);
							$(div).append(brand_span);
							$(div).append(title_span);
							$(div).append(price_span);
							$(div).append(cart_btn);
							$(div).append(buy_btn);
							$(".product-result").append(div);
						}

						add_to_cart();
						buy_btn_code();

					}
			}
		});
	});
});


// email subscribe btn code

$(document).ready(function(){
	$(".subscribe-btn").click(function(e){
		e.preventDefault();
		var email = $(".subscribe-email").val();
		$.ajax({
			type : "POST",
			url : "http://localhost/shop/pages/php/subscribe_verify.php",
			data : {
				email : email
			},
			success : function(response)
			{
				if(response.trim() != "unable to send verification code")
				{ 
					var count = 3;
					function verify()
					{
						var data = JSON.parse(response.trim());
						var code = data[1];
						window.prompt("Please visit your email and enter your verification code");
						if(prompt == code)
						{
							$.ajax({
								type : "POST",
								url : "http://localhost/shop/pages/php/subscriber.php",
								data : {
									email : email
								},
								success : function(response)
								{
									alert(response);
								}
							});
						}

						else if(prompt == null || prompt == "")
						{
							verify();
						}
						else
						{
							alert("your verification code is wrong");
							if(--count>0)
							{
							verify();
							}
						}
					}

					verify();
				}
				else
				{
					alert(response);
				}
			}
		});
	});
	
});


// live search 

$(document).ready(function(){
	$(".search").on("input", function(){
		var keyword = $(this).val();
		$.ajax({
			type : "POST",
			url : "http://localhost/shop/pages/php/live_search.php",
			data : {
				keyword : keyword
			},
			success : function(response)
			{
				$(".search-hint").html(response);
				$(".search-tag").on("mouseover",function(){
					$(this).css({
						backgroundColor : "red",
						color : "white",
						cursor : "pointer"
					});
				});
				$(".search-tag").on("mouseout",function(){
					$(this).css({
						backgroundColor : "inherit",
						color :"inherit"
					});
				});
				$(".search-tag").each(function(){
					$(this).click(function(){
						var id = $(this).attr("product-id");
						$(".search").val($(this).html());
						$(".search-hint").html("");
						window.location = "http://localhost/shop/pages/php/buy_product.php?id="+id;
					});
				});
			}
		});
	});
});


//search 

$(document).ready(function(){
	$(".search").on("keypress", function(e){
		if(e.keyCode == 13 && $(this).val() != "")
		{
			var keyword = $(this).val().trim();
			window.location = "http://localhost/shop/search/"+keyword;

		}
	});
});

$(document).ready(function(){
	$(".search-icon").on("click", function(e){
		if($(this).val() != "")
		{
			var keyword = $(".search").val().trim();
			window.location = "http://localhost/shop/pages/php/search_result.php?search="+keyword;

		}
		else
		{
			alert("write somethink in search");
		}
	});
});