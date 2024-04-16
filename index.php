<?php 
include "app/config.php";
date_default_timezone_set('asia/calcutta');
$browser_t="web";
$split = explode("?",$page_name);
if ($page_name=='') {$index="active";
	include $browser_t.'/index.php';
	}
	
	elseif ($page_name=='index') { $index="active";
	include $browser_t.'/index.php';
	}
		elseif ($part_url['1']=='Category') { $category="active";
	include $browser_t.'/category.php';
	}
	elseif ($page_name=='Cart') { $index="active";
	include $browser_t.'/cart.php';
	}
	elseif ($page_name=='Checkout') { $index="active";
	include $browser_t.'/checkout.php';
	}
	elseif ($page_name=='Login') { $index="active";
	include $browser_t.'/login.php';
	}
	elseif ($page_name=='sign-up') { $index="active";
	include $browser_t.'/sign-up.php';
	}
	elseif ($page_name=='sign-up-success') { $index="active";
	include $browser_t.'/sign-up.php';
	}
	elseif ($page_name=='sign-up-post') { $index="active";
	include 'app/reg.php';
	}
	elseif ($page_name=='Sign-in-post') { $index="active";
	include 'app/login.php';
	}
	elseif ($page_name=='lost-password') { $index="active";
	include $browser_t.'/lost.php';
	}
	elseif ($page_name=='About-Us') { $about="active";
	include $browser_t.'/about.php';
	}
	elseif ($page_name=='terms') { $about="active";
	include $browser_t.'/terms.php';
	}
		elseif ($page_name=='disclaimer') { $services="active";
	include $browser_t.'/disclaimer.php';
	}
	elseif ($page_name=='account-settings') { $services="active";
	include $browser_t.'/account.php';
	}
	elseif ($page_name=='otp') { $index="active";
	include 'app/otp.php';
	}
	elseif ($page_name=='logout') { $index="active";
	include 'app/logout.php';
	}
	elseif ($page_name=='wallet') { $services="active";
	include $browser_t.'/wallet.php';
	}
	elseif ($page_name=='downloads') { $services="active";
	include $browser_t.'/downloads.php';
	}
	elseif ($page_name=='lost-post') { $index="active";
	include 'app/lost.php';
	}
	elseif ($page_name=='Search') { $category="active";
	include $browser_t.'/category.php';
	}
	elseif ($page_name=='remove-cart') { $index="active";
	include 'app/remove-cart.php';
	}
	elseif ($page_name=='payment') { $index="active";
	include 'app/payment.php';
	}
	elseif ($page_name=='wallet-add-money') { $index="active";
	include 'app/walletadd.php';
	}
	elseif ($page_name=='wallet-money') { $index="active";
	include 'app/walletmoney.php';
	}
	elseif ($page_name=='changepassword') { $index="active";
	include 'app/changepassword.php';
	}
	elseif ($page_name=='PRIVACY-POLICY') { $gallery="active";
	include $browser_t.'/privacy.php';
	}
	elseif ($part_url['1']=='invoice') { $gallery="active"; 
	include 'invoice.php';
	}

		
	
	
	elseif ($page_name=='Contact-Us') { $contact="active";
	include $browser_t.'/contact.php';
	}
	elseif ($page_name=='Artist-Reg') { $Artist="active";
	include $browser_t.'/artist_book.php';
	}
		elseif ($part_url['2']=='Photos') { $gallery="active";
	include $browser_t.'/photos.php';
	}

	elseif ($part_url['2']=='Book') { $index="active";
	include $browser_t.'/artist_book_service.php';
	}
	elseif ($page_name=='Contact-Post') {$Contact="active";
	include 'app/contact.php';
	}
	elseif ($page_name=='Artist-Reg-Post') {$Contact="active";
	include 'app/artist_reg.php';
	}
	elseif ($page_name=='Artist-Book-Post') {$Contact="active";
	include 'app/artist_book_services.php';
	}
	elseif ($page_name=='error.html') {
	include $browser_t.'/404.php';	}
	else
	{
		$index="active";
		include $browser_t.'/index.php';
	}
?>