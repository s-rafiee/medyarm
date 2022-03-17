<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Lesson;
use App\Models\Link;
use Illuminate\Http\Request;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $data = array();
        return view('panel.index');
        while (true) {
            $post = new Lesson();
            $post->internet = "1";
            $post->root = "0";
            $post->data = "0";
            $post->mode = "0";
            $post->price = "بصورت رایگان عرضه شده است";
            $post->necessary = "1";
            $post->user_id = "1";
            $post->cat_id = rand(11, 14);
            $post->developer_id = "1";
            $post->version = "7.0.1";
            $post->installed = "بیش از یک میلیارد";
            $post->rating = rand(0, 5);
            $post->os = "4.3 به بالا";
            $post->age = "13 سال به بالا";
            $post->visit = rand(0, 10000);
            $post->active = 1;
            $i = rand(0, 1);
            $id = 0;
            if ($i) {
                $post->title = "برنامه واتساپ";
                $post->description = "دانلود واتساپ - برنامه whatsApp اندروید ورژن 7.0.1";
                $post->title_en = "whatsApp messanger";
                $post->image = '\photos\1\apps\whatsapp-cover.png';
                $post->icon = '\photos\1\icons\250_whatsApp_icon.png';
                $post->change = '<ul> <li style="text-align: right;">اضافه شدن حالت دارک مود (حالت شب)</li> <li style="text-align: right;">اضافه شدن بازگشایی قفل برنامه با اثر انگشت</li> <li style="text-align: right;">امکان به اشتراک گذاشتن وضعیت در برنامه های دیگر</li> <li style="text-align: right;">پخش شدن پیام های صوتی پشت سر هم به صورت اتوماتیک</li> <li style="text-align: right;">رفع برخی مشکلات امنیتی</li> <li style="text-align: right;">&nbsp;</li> </ul>';
                $post->body = '<div class="section-body"><p><strong>واتساپ </strong>- <strong>whatsapp </strong>اندروید&nbsp;محبوب ترین پیام رسان در میان ایرانیان و سومین در جهان می باشد و توسط شرکت <a title="فیس بوک" href="https://fa.wikipedia.org/wiki/%D9%81%DB%8C%D8%B3%E2%80%8C%D8%A8%D9%88%DA%A9" target="_blank" rel="noopener">فیس بوک</a> و شخص <a title="مارک زاکربرگ" href="https://fa.wikipedia.org/wiki/%D9%85%D8%A7%D8%B1%DA%A9_%D8%B2%D8%A7%DA%A9%D8%B1%D8%A8%D8%B1%DA%AF" target="_blank" rel="noopener">مارک زاکربرگ</a> خریداری شد. برای <strong>به روز رسانی</strong> و&nbsp;<strong>دانلود واتساپ</strong> جدید با لینک مستقیم اندروید با ما همراه باشید.&nbsp;</p> <p>این مسنجر نرم افزاری برای چت و گفتگو آنلاین می باشد که برای پلتفرم های اندروید، آی او اس ، و ویندوز عرضه می شود. چت، گفتگو و یا تماس صوتی و تصویری در این پیامرسان رایگان می باشد؛ این بدین معنی است که شما تنها هزینه اینترنت را برای استفاده از این مسنجر باید بپردازید و هیچگونه هزینه ی دیگری از سیم کارت شما کسر نمی شود.</p> <p>از نظر جهانی واتساپ اصلی دارای بیشترین کاربر فعال نسبت به سایر پیام رسان ها می باشد و <a title="تلگرام" href="../../../telegram" target="_blank" rel="noopener">تلگرام</a> یکی از رقیبان اصلی این پیام رسان می باشد که به سرعت در میان ایرانیان جا باز کرده و کاربران زیادی حتی بیشتر از whatsapp دارد.</p> <h2>واتساپ اصلی رایگان است!</h2> <p>رایگان بودن <a title="واتساپ" href="../../../whatsapp-messenger" target="_blank" rel="noopener">واتساپ</a>&nbsp;اصلی اندروید باعث شده تا افراد برای ارتباطات با مخاطبین سایر کشورها که هزینه آن زیاد و سرسام آور از این پیامرسان محبوب استفاده کنند. همچنین این مسنجر دارای قابلیت چت و گفتگوی گروهی اعم صوتی و تصویری است که این قابلیت یکی از جذابیت های این پیام رسان می باشد.</p> <p>whatsapp جدید، مانند <a title="اینستاگرام" href="../../../instagram">اینستاگرام</a> و <a title="اسنپ چت" href="../../../snapChat">اسنپ چت</a> دارای بخشی به نام استوری (داستان) است که شما در آن میتوانید عکس یا ویدیو های کوتاه رو در مورد شرح حال روزانه یا ثبت وقایع روزمره خود با دیگر مخاطبین خود به اشتراک بگذارید؛ البته این عکس یا ویدیو ها فقط برای 24 ساعت برای مخاطبین شما قابل نمایش می باشند و پس از آن به صورت اتوماتیک پاک می شوند.</p> <h2>امنیت واتساپ:</h2> <p>واتساپ برای امنیت پیام رسان خود از فناوری <a title="رمزگذاری سرتاسر" href="https://fa.wikipedia.org/wiki/%D8%B1%D9%85%D8%B2%DA%AF%D8%B0%D8%A7%D8%B1%DB%8C_%D8%B3%D8%B1%D8%AA%D8%A7%D8%B3%D8%B1" target="_blank" rel="noopener">رمزگذاری سرتاسر</a>&nbsp;(به&nbsp;انگلیسی:&nbsp;<span lang="en">End-to-end encryption</span>) بهره می برد. با استفاده از رمزگذاری سرتاسر پیام ها، عکسها، فایل های ویدئویی و تماس های صوتی و تصویری به جز شما و شخصی که با آن در ارتباط هستید، به دست افراد ثالث نمی افتد.</p> <p>بسیاری از پیام رسان ها، پیام های شما را به صورت یک طرفه بین خودشان و شما رمزگذاری می کنند. اما رمزگذاری سرتاسر واتساپ پیام ها بین شما و مخاطبتان که با او در مکالمه هستید رمزگذاری می شود؛ یعنی فقط شما و مخاطبتان کلید باز کردن پیام و مشاهده آن را دارید و غیر شما کسی دیگر قادر به مشاهده و شنیدن مکالمه شما نیست.</p> <h3>پیام های که در واتساپ با شما باقی میمانند:</h3> <p>برخلاف پیام رسان های دیگر مانند تلگرام که پیام های شما را در سرور های خود تا ابد ذخیره می کنند. پیام های شما در واتساپ همیشه در اختیار خودتان هستند. چون این پیام رسان پیام های شما را پس از تحویل در سرورهای خود ذخیره نمی کند. در این صورت به جز شما و مخاطبتان هیچکس حتی خود واتساپ به پیام های شما دسترسی ندارد.</p> <p style="text-align: center;"><img src="\photos\apps\whatsapp-cover.png" alt="دانلود واتساپ" width="600" height="300"></p> <h2>ویژگی های واتساپ جدید و اصلی اندروید:</h2> <ul> <li>دارای قابلیت گفتگوی صوتی و تصویری</li> <li>دارای انواع شکلک (ایموجی)های جذاب که شما را در انتقال پیام کمک می کنند.</li> <li>بدون تبلیغات بودن و ساده بودن محیط کاربری&nbsp;</li> <li>امکان ارسال انواع فایل برای یکدیگر&nbsp;</li> <li>امکان به اشتراک گذاشتن موقعیت خود با سایر دوستان</li> <li>امکان ساخت گروه خانوادگی و یا دوستانه&nbsp;</li> <li>امکان پاسخ دادن به یک چت قدیمی در پیام ها</li> </ul> <p>واتساپ جدید با امتیاز 4.7 از 5 در گوگل پلی&nbsp;بیش از یک میلیارد بار توسط کاربران سرتاسر جهان دانلود و نصب شده است. که ما در سایت تینروید آخرین نسخه از این پیام رسان محبوب را برای شما کاربران عزیز قرار داده ایم.</p> <p>- برای به روز رسانی و <strong>دانلود واتساپ جدید</strong> اندروید با لینک مستقیم به پایین صفحه مراجعه کنید.</p></div>';
                $post->save();
                $id = DB::getPdo()->lastInsertId();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g11.png';
                $g->post_id = $id;
                $g->save();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g22.png';
                $g->post_id = $id;
                $g->save();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g33.png';
                $g->post_id = $id;
                $g->save();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g44.png';
                $g->post_id = $id;
                $g->save();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g55.png';
                $g->post_id = $id;
                $g->save();
            } else {
                $post->title = "بازی کلش اف کلنز";
                $post->description = "دانلود کلش اف کلنز - بازی clash of clans اندروید 6.0.1";
                $post->title_en = "clash of clans";
                $post->image = '\photos\1\apps\clash-of-clans_cover.jpg';
                $post->icon = '\photos\1\icons\128_clash-of-clans.png';
                $post->change = '<ul> <li style="text-align: right;">اضافه شدن حالت زمستان و کریسمس</li> <li style="text-align: right;">اضافه شدن تاون هال 13</li> <li style="text-align: right;">اضافه شدن کاراکتر و وسایل دفاعی جدید</li> <li style="text-align: right;">بهینه سازی و رفع برخی مشکلات</li> </ul>';
                $post->body = '<p><strong>&nbsp;کلش اف کلنز </strong>-<strong> Clash of Clans </strong>اندروید بازی جذاب و پرطرفدار به سبک استراتژی می باشد که شما باید در این بازی دهکده ی خود را احیاء و آن را درمقابل حملات دشمنان و دیگر قبیله ها مستحکم و غیر قابل نفوذ نمایید. برای به روز رسانی و <strong>دانلود کلش اف کلنز </strong>جدید با لینک مستقیم با ما همراه باشید.</p> <p>clash of clans ساخت شرکت <a title="سوپرسل" href="https://fa.wikipedia.org/wiki/%D8%B3%D9%88%D9%BE%D8%B1%D8%B3%D9%84" target="_blank" rel="noopener">سوپرسل</a> که یکی از شرکت های معروف سازنده ی بازیهای استراتژی مانند boom beach، <a title="کلش رویال" href="../../../clash-royale" target="_blank" rel="noopener">کلش رویال</a> و ... است. با نصب این بازی شما با میلیون ها کاربر که در سراسر جهان در این بازی حضور دارند به رقابت می پردازید.</p> <h2>هدف بازی کلش اف کلنز اندروید:</h2> <p>هدف شما در بازی حمله به قبیله های دیگر برای جمع آوری منابع برای ساخت قبیله خود است. همچنین شما باید با نحوه ی چینش عناصر و ساختارهای دفاعی خود قبیله خود را از نظر حمله دشمن تقویت کنید.</p> <p>&nbsp;شما با شرکت در کلن وار بازی کلش اف کلنز می توانید با قبیله های دیگر متحد شده و جنگ قبیله ای عظیمی به راه بیاندازید. که در این نوع جنگ شما در صورت پیروزی منابع عظیمی به دست خواهید آورد.</p> <h2>برای به دست آوردن منابع بیشتر به دهکده های مرده اتک بزنید!</h2> <p>برای به دست آوردن منابع بیش تر شما می توانید به هنگام سرچ دهکده برای اتک زدن، دنبال دهکده های بگردید که صاحب آن مدت ها است به آن سر نزده است و این نوع قبیله ها معادن ومنبع <a title="اکسیر" href="https://fa.wikipedia.org/wiki/%D8%A7%DA%A9%D8%B3%DB%8C%D8%B1" target="_blank" rel="noopener">اکسیر</a> آن ها کاملا پر می باشد و اکثر تله ها از کار افتاده اند؛ در اصطلاح به این نوع دهکده ها، دهکده مرده می گویند. برای آپدیت این بازی و بازی های دیگر مانند <a title="شادو فایت 3" href="../../../shadow-fight-3" target="_blank" rel="noopener">شادو فایت 3</a> و&nbsp;<a title="آمیرزا" href="../../../amirza" target="_blank" rel="noopener"> آمیرزا</a> سایت تینروید را به خاطر بسپارید.</p> <p style="text-align: center;"><img src="/photos/1/apps/clash-of-clans_cover.jpg" alt="دانلود کلش اف کلنز " width="600" height="350"></p> <blockquote> <p>دقت فرمایید چیزی به عنوان <strong>بازی کلش اف کلنز مود</strong>، بی نهایت و هک شده که در فضای اینترنت منتشر شده است، وجود ندارد.</p> </blockquote> <h2>ویژگی های بازی کلش اف کلنز جدید اندروید:</h2> <ul> <li>گرافیگ فوق العاده زیبا و جذاب با صداگذاری عالی</li> <li>امکان شرکت در جنگ های آنلاین با کاربران سرتاسر جهان</li> <li>امکان ارتقاء قبیله با شکست دشمنان و بدست آوردن منابع</li> <li>پشتیبانی از زبان های مختلف از جمله فارسی</li> <li>امکان چت کردن با دوستان و افراد دیگر</li> <li>شرکت در کلن وار ها و بدست آوردن منابع بیشتر</li> </ul> <p>کلش اف کلنز جدید با امتیاز 4.6 از 5 در <a title="گوگل پلی" href="https://fa.wikipedia.org/wiki/%DA%AF%D9%88%DA%AF%D9%84_%D9%BE%D9%84%DB%8C" target="_blank" rel="noopener">گوگل پلی</a> بیش از 500 میلیون بار توسط کاربران سرتاسر جهان دانلود و نصب شده است. که ما در سایت تینروید&nbsp;آخرین نسخه از این بازی محبوب را برای شما کاربران عزیز قرار داده ایم.</p> <p>- برای دانلود و <strong>به روزرسانی</strong> بازی clash of clans نسخه جدید برای اندروید با لینک مستقیم به پایین صفحه بروید.</p> <p style="text-align: center;">همچنین میتوانید <a title="نیتروگرام" href="../../../nitrogram" target="_blank" rel="noopener">نیتروگرام</a> نسخه پیشرفته تلگرام را از اینجا دانلود کنید.</p>';
                $post->save();
                $id = DB::getPdo()->lastInsertId();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g1.png';
                $g->post_id = $id;
                $g->save();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g2.png';
                $g->post_id = $id;
                $g->save();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g3.png';
                $g->post_id = $id;
                $g->save();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g4.png';
                $g->post_id = $id;
                $g->save();
                $g = new Gallery();
                $g->url = '\photos\1\gallerys\g5.png';
                $g->post_id = $id;
                $g->save();
            }
            $l = new Link();
            $l->title = 'دانلود نسخه 2.20.64 برنامه مخصوص دستگاه های ARM64 اندروید 4.0.3+';
            $l->size = '33.5 مگابایت';
            $l->url = '/files/a.apk';
            $l->post_id = $id;
            $l->save();
            $l = new Link();
            $l->title = 'دانلود نسخه 2.20.64 برنامه مخصوص دستگاه های X86 و 64 اندروید 4.0.3+';
            $l->size = '48 مگابایت';
            $l->url = '/files/a.apk';
            $l->post_id = $id;
            $l->save();
            $l = new Link();
            $l->title = 'دانلود نسخه 2.20.64 برنامه مخصوص دستگاه های X86 و 64 اندروید 4.0.3+';
            $l->size = '29 مگابایت';
            $l->url = '/files/a.apk';
            $l->post_id = $id;
            $l->save();
            $l = new Link();
            $l->title = 'دانلود نسخه 2.20.64 برنامه مخصوص تمامی دستگاه های اندروید 4.0.3+';
            $l->size = '29 مگابایت';
            $l->url = '/files/a.apk';
            $l->post_id = $id;
            $l->save();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
