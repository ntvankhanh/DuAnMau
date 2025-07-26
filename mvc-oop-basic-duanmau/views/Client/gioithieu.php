
<?php include __DIR__ . '/layout/Header.php'; ?>


<style>
  body {
    background: #f4f6fb;
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
  }
  .about-hero {
    background: linear-gradient(120deg, #e0e7ef 0%, #f4f6fb 100%);
    border-radius: 1.5rem;
    box-shadow: 0 4px 32px rgba(60, 72, 100, 0.08);
    padding: 2.5rem 2rem 2rem 2rem;
    margin-bottom: 2.5rem;
    display: flex;
    align-items: center;
    gap: 2.5rem;
    flex-wrap: wrap;
  }
  .about-hero-img {
    width: 180px;
    height: 180px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0 2px 16px rgba(60, 72, 100, 0.10);
    border: 6px solid #fff;
    background: #fff;
    margin: 0 auto;
    transition: transform 0.3s;
  }
  .about-hero-img:hover {
    transform: scale(1.05) rotate(-2deg);
  }
  .about-hero-content h1 {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 1rem;
    letter-spacing: 1px;
  }
  .about-hero-content p {
    font-size: 1.2rem;
    color: #64748b;
    margin-bottom: 0;
  }
  .about-section {
    background: #fff;
    border-radius: 1.2rem;
    box-shadow: 0 2px 16px rgba(60, 72, 100, 0.07);
    padding: 2.5rem 2rem;
    margin-bottom: 2.5rem;
  }
  .about-section-title {
    color: #2563eb;
    font-weight: 700;
    font-size: 1.5rem;
    margin-bottom: 1.2rem;
    letter-spacing: 0.5px;
  }
  .about-section p, .about-section ul {
    color: #475569;
    font-size: 1.08rem;
  }
  .about-list {
    padding-left: 0;
    margin-bottom: 2rem;
  }
  .about-list li {
    list-style: none;
    margin-bottom: 0.7rem;
    display: flex;
    align-items: center;
    font-size: 1.08rem;
    color: #334155;
  }
  .about-list-icon {
    color: #2563eb;
    font-size: 1.3rem;
    margin-right: 0.7rem;
  }
  .about-contact-link {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
  }
  .about-contact-link:hover {
    color: #1d4ed8;
    text-decoration: underline;
  }
</style>


<main class="container my-5">
  <div class="about-hero mb-5">
    <img src="https://i.pinimg.com/originals/b0/1e/be/b01ebeca4a562b2ebcc3547d328eef36.jpg" class="about-hero-img" alt="Cherry Cakes">
    <div class="about-hero-content">
      <h1>Cherry Cakes - Sáng tạo vị ngọt, nâng tầm trải nghiệm</h1>
      <p>Chúng tôi là thương hiệu bánh ngọt hiện đại, chuyên nghiệp, luôn đổi mới để mang đến những sản phẩm chất lượng và dịch vụ tận tâm nhất cho khách hàng.</p>
    </div>
  </div>

  <div class="about-section mb-4">
    <h2 class="about-section-title">Sứ mệnh của chúng tôi</h2>
    <p>Cherry Cakes cam kết sử dụng nguyên liệu cao cấp, quy trình sản xuất chuẩn quốc tế và đội ngũ thợ bánh sáng tạo để tạo ra những chiếc bánh không chỉ ngon mà còn đẹp mắt, phù hợp mọi dịp lễ, sự kiện.</p>
  </div>

  <div class="about-section mb-4">
    <h2 class="about-section-title">Giá trị cốt lõi</h2>
    <ul class="about-list">
      <li><i class="bi bi-check2-circle about-list-icon"></i>Chất lượng & an toàn thực phẩm là ưu tiên số 1</li>
      <li><i class="bi bi-lightbulb about-list-icon"></i>Luôn đổi mới, sáng tạo trong từng sản phẩm</li>
      <li><i class="bi bi-people about-list-icon"></i>Phục vụ tận tâm, chuyên nghiệp</li>
      <li><i class="bi bi-chat-dots about-list-icon"></i>Lắng nghe và thấu hiểu khách hàng</li>
    </ul>
  </div>

  <div class="about-section mb-4">
    <h2 class="about-section-title">Liên hệ với chúng tôi</h2>
    <p>Nếu bạn có bất kỳ thắc mắc hoặc cần tư vấn, hãy liên hệ với Cherry Cakes qua:</p>
    <ul class="about-list">
      <li><i class="bi bi-telephone about-list-icon"></i><strong>Hotline:</strong> <a href="tel:0985914005" class="about-contact-link">0985 914 005</a></li>
      <li><i class="bi bi-envelope about-list-icon"></i><strong>Email:</strong> <a href="mailto:khanhntvph52932@gmail.com" class="about-contact-link">khanhntvph52932@gmail.com</a></li>
    </ul>
  </div>
</main>

<?php include __DIR__ . '/layout/footer.php'; ?>