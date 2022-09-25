<?php
/**
 * Default Template for Every Status
 */

$template_pending_for_user = '⌛ Pesanan : *{{status_text}}*

Hi *{{name}}*
Terimakasih telah melakukan pemesanan
Berikut ini adalah detail pesanan anda:
ID Pesanan : *#{{order_id}}*

*Detail Pesanan*
{{summary}}

Segera lakukan pembayaran
agar pesanan anda dapat segera kami proses.

*Pembayaran*
{{payment}}

Salam Hangat
*LWCommerce*

_Tolong abaikan pesan ini jika anda tidak pernah melakukan pemesanan_ 😊';

$template_paid_for_user = '💳 Pesanan : *{{status_text}}*

Hi, *{{name}}*
Pembayaran sudah kami terima,
Pesanan anda segera akan kami proses 

Salam Hangat
*LWCommerce*';

$template_processing_for_user = "🔄 Pesanan : *{{status_text}}*

Hi *{{name}}*
Pesanan kamu tersedia, dan sedang
kami siapkan. mohon tunggu ya
{{pickup}}

Salam Hangat
*LWCommerce*";

$template_pickup_for_user = "👋 Pesanan : *{{status_text}}*

Hi {{name}}
Pesanan anda sudah selesai, dan
sudah siap diambil di kasir

Daftar Pesanan *#{{order_id}}*
{{pickup_list}}

Balas pesan ini dengan pesan : 
“{{store_name}}”
lalu tunjukan pesan ini saat 
mengambil pesanan dikasir.

Terimakasih
*LWCommerce*";

$template_shipped_for_user = "🚚 Pesanan : *{{status_text}}*

Hi {{name}}
Pesanan anda sudah di Kirim
menggunakan kurir : 
*{{courier}}*

Lacak Pengiriman :
{{tracking_link}}

Salam Hangat
*LWCommerce*";

$template_completed_for_user = '✅ Pesanan : *{{status_text}}*

Terimakasih *{{name}}*
telah membeli berbelanja di toko kami

jika perlu sesuatu, silahkan chat kami
di nomor whatsapp ini 😊

Salam Hangat
*LWCommerce*';

$template_cancelled_for_user = "❌ Pesanan : *{{status_text}}*

Hi *{{name}}*
Maaf sekali tapi pesanan anda kami 
batalkan, karena
{{reason}}

Salam Hangat
*LWCommerce*";

// -------------------- Admin ------------------------ //

$template_pending_for_admin = 'Order Baru Min !!!
{{total}}';

$template_completed_for_admin = 'Order Selesai Min !!!';