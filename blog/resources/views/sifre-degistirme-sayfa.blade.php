<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <title>Şifre Değiştir</title>
  <style>
    body {
      background-color: whitesmoke;
      cursor: default;
    }

    .SifreDegistir {
      background-color: #e6f4ea;
      padding: 30px;
      width: 350px;
      margin: 200px auto;
      border-radius: 10px;
      height: 260px;
    }

    .SifreDegistir input {
      width: 100%;
      padding: 5px;
    }

    .SifreDegistir button {
      background-color: white;
      border: none;
      border-radius: 6px;
      padding: 7px 14px;
      cursor: pointer;

    }

    .tus {
      display: flex;
      justify-content: center;
      gap: 20px;
      cursor: pointer;
      border: none;
      border-radius: 6px;
      text-align: center;
    }
  </style>

</head>

<body>


  <div class="SifreDegistir">
    <h2 style="text-align: center;">Şifre Değiştir</h2>
    <input type="email" id="email" placeholder="Email adresiniz" required><br><br>
    <input type="password" id="eskiSifre" placeholder="Eski şifre" required><br><br>
    <input type="password" id="yeniSifre" placeholder="Yeni şifre" required><br><br>
    <br>
    <div class="tus">
      <button onclick="sifreDegistir()" style="padding: 7px 14px">Şifreyi Güncelle</button>
      <a href="/giris-sayfa.html"><button type="button"> Giris Yap </button></a>
    </div>
  </div>

  <script>
    function sifreDegistir() {
      const email = document.getElementById("email").value;
      const eskiSifre = document.getElementById("eskiSifre").value;
      const yeniSifre = document.getElementById("yeniSifre").value;

      if (!(email && eskiSifre && yeniSifre)) {
        alert("Tüm alanlar zorunludur.");
        return;
      }

      fetch("/kullanici-yonetici/sifre-degistirme-sayfa", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email, eskiSifre, yeniSifre })
      })
        .then(res => res.text())
        .then(msg => {
          alert(msg);
          if (msg.includes("başarıyla")) {
            window.location.href = "/giris-sayfa.html"; // geri dön
          }
        })
        .catch(err => alert("Hata: " + err.message));
    }
  </script>
</body>

</html>