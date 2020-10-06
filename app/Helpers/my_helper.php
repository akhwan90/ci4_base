<?php 

function cek_login() {
	if (session('username') == null) {
		return redirect()->to('auth');
	} 
}

?>
