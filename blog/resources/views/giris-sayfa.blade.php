<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />

  <title>Giriş Sayfası </title>
  <style>
    body {
      background-color: whitesmoke;
      cursor: default;
    }

    #girisForm {
      background-color: #e6f4ea;
      padding: 20px;
      width: 350px;
      margin: 160px auto;
      border-radius: 10px;

      /* position: relative; */
    }

    #girisForm input {
      width: 100%;
      padding: 4px;
    }

    #girisForm button {
      background-color: white;
      border: none;
      border-radius: 6px;
      padding: 7px 14px;

    }

    .butonlar {
      display: flex;
      justify-content: center;
      gap: 5px;
      padding: 10px 10px;
      border: none;
      border-radius: 6px;
       /* cursor: pointer; */
    }

    .girisKutusu {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  </style>

</head>

<body>


  <div class="girisKutusu">
    <form id="girisForm">
      <h1 style="text-align: center;">Kullanıcı Girişi</h1>
      <label>Email:</label><br />
      <input type="email" id="email" required /><br /><br />

      <label>Şifre:</label><br />
      <input type="password" id="sifre" required /><br /><br />
      <div class="butonlar">
        <button type="submit" style="cursor: pointer;">Giriş Yap</button><br>
        <a href="/sifre-degistirme-sayfa.html"><button type="button " style="cursor: pointer;">Şifre Değiştir</button></a>
      </div>

      <p id="mesaj"></p>
      <p>
        Hesabınız yok mu? <a href="/kayit-olma-sayfa.html"><button type="button" style="cursor: pointer;">Kayıt Ol </button></a>
      </p>
    </form>
  </div>

  <script>
    document.getElementById("girisForm").addEventListener("submit", function (e) {
      e.preventDefault();

      const email = document.getElementById("email").value;
      const sifre = document.getElementById("sifre").value;
      const mesajP = document.getElementById("mesaj");

      fetch("http://localhost:6005/kullanici-yonetici/giris-sayfa", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, sifre })
      })
        .then(res => {
          if (!res.ok) throw new Error("Giriş başarısız");
          return res.json();
        })


        .then(data => {
          // ✅ Giriş başarılıysa kullanıcıyı localStorage'a kaydet
          localStorage.setItem("oturum", JSON.stringify(data.kullanici));

          mesajP.textContent = " Giriş başarılı! Hoş geldiniz ";
          mesajP.style.color = "green";
          mesajP.style.textAlign = "center";

          //  Ana sayfaya yönlendir
          setTimeout(() => {
            window.location.href = "etkinlikler-sayfa.html";
          }, 1500);
        })
        .catch(err => {
          mesajP.textContent = " Giriş başarız tekrar deneyiniz!!! ";
          mesajP.style.color = "red";
          mesajP.style.textAlign = "center";
        });
      //  err.message
    });

    function sifreDegistir() {
      const email = prompt("Email adresinizi girin:");
      const eskiSifre = prompt("Mevcut şifrenizi girin:");
      const yeniSifre = prompt("Yeni şifrenizi girin:");

      if (!(email && eskiSifre && yeniSifre)) {
        alert("Lütfen tüm alanları doldurun.");
        return;
      }

      fetch("/kullanici-yonetici/sifre-degistirme-sayfa", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, eskiSifre, yeniSifre })
      })
        .then(res => res.text())
        .then(msg => alert(msg))
        .catch(err => alert("Hata: " + err.message));
    }

  </script>
</body>

</html>