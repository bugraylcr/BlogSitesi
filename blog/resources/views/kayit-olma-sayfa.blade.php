<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />
  <title>Kayıt Olma Sayfası</title>
  <style>
    body {
      background-color: whitesmoke;
      cursor: default;
    }

    #kayitForm {
      background-color: #e6f4ea;
      padding: 15px;
      width: 355px;
      margin: 190px auto;
      border-radius: 10px;

    }

    #kayitForm input {
      width: 100%;
      padding: 4px;
    }

    #kayitForm button {
      background-color: white;
      border: none;
      border-radius: 4px;
      padding: 7px 14px;

    }

    .buton {
      margin-top: 2px;
      margin-bottom: 2px;
      display: flex;
      justify-content: center;
      gap: 3px;
      padding: 6px 6px;
      border: none;
      border-radius: 2px;
      cursor: pointer;
    }
  </style>

</head>

<body>



  <form id="kayitForm">
    <h1 style="text-align: center;">Kayıt Ol</h1>
    <label>Email:</label><br />
    <input type="email" id="email" required /><br /><br />

    <label>Şifre:</label><br />
    <input type="password" id="sifre" required /><br /><br />
    <div class="buton"> <button type="submit">Kayıt Ol</button>
    </div>
    <p id="mesaj"></p>
    <p style="text-align: center;">Zaten hesabınız var mı? <a href="giris-sayfa.html">Giriş Yap</a></p>

  </form>


  <script>
    document.getElementById("kayitForm").addEventListener("submit", function (e) {
      e.preventDefault();

      const email = document.getElementById("email").value;
      const sifre = document.getElementById("sifre").value;
      const mesajP = document.getElementById("mesaj");

      fetch("http://localhost:6005/kullanici-yonetici/kayit-olma-sayfa", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, sifre })
      })
        .then(res => {
          if (!res.ok) throw new Error("Kayıt başarısız");
          return res.json();
        })
        .then(data => {
          mesajP.textContent = " Kayıt başarılı!";
          mesajP.style.textAlign = "center";
          mesajP.style.color = "green";
          setTimeout(() => {
            window.location.href = "giris-sayfa.html";
          }, 1500);
        })
        .catch(err => {
          mesajP.textContent = " Hata: " + err.message;
          mesajP.style.color = "red";
          mesajP.style.textAlign = "center";
        });
    });
  </script>
</body>

</html>