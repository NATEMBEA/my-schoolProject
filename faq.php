<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ - Client Management System</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9; /* Light background */
      margin: 0;
      padding: 0;
    }

    .faq-container {
      max-width: 800px;
      margin: 50px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .faq-container h1 {
      text-align: center;
      color: #8174A0; /* Primary color for headings */
      margin-bottom: 30px;
    }

    .faq-item {
      border-bottom: 1px solid #e0e0e0;
      padding: 15px 0;
    }

    .faq-item:last-child {
      border-bottom: none;
    }

    .faq-question {
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
      font-size: 18px;
      font-weight: bold;
      color: #8174A0; /* Primary color for questions */
    }

    .faq-question:hover {
      color: #EFB6C8; /* Hover color */
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-out;
      color: #555;
      line-height: 1.6;
    }

    .faq-answer p {
      margin: 10px 0 0;
    }

    .faq-item.active .faq-answer {
      max-height: 200px; /* Adjust based on content */
    }

    .faq-item.active .faq-question {
      color: #EFB6C8; /* Active question color */
    }

    .faq-toggle {
      font-size: 24px;
      transition: transform 0.3s ease;
      color: #8174A0; /* Toggle icon color */
    }

    .faq-item.active .faq-toggle {
      transform: rotate(45deg);
      color: #EFB6C8; /* Active toggle icon color */
    }
  </style>
</head>
<body>
  <div class="faq-container">
    <h1>Frequently Asked Questions</h1>


    <!-- FAQ Item 1 -->
    <div class="faq-item">
      <div class="faq-question">
        <span>Is there a registration fee?</span>
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        <p>Yes, we charge a small one-time registration fee of KSH.50 to cover platform costs.</p>
        <p>You can pay securely using your mpesa,credit/debit card during the registration process and theregistration fee is non-refundable</p>

        
      </div>
    </div>

    <!-- FAQ Item 1 -->
    <div class="faq-item">
      <div class="faq-question">
        <span>What is the purpose of this project?</span>
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        <p>
          The purpose of this project is to develop a web-based platform that connects local software developers in Kenya with clients seeking software products and services. It aims to bridge the communication gap between developers and clients, providing a localized solution tailored to the Kenyan market.
        </p>
      </div>
    

    <!-- FAQ Item 2 -->
    <div class="faq-item">
      <div class="faq-question">
        <span>How is this platform different from global freelancing platforms like Upwork?</span>
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        <p>
          Unlike global platforms, this system is specifically designed for the Kenyan market. It integrates local payment methods like M-Pesa, offers lower commission fees, and provides features tailored to the needs of Kenyan clients and developers.
        </p>
      </div>
    </div>

    <!-- FAQ Item 3 -->
    <div class="faq-item">
      <div class="faq-question">
        <span>What features will the platform offer?</span>
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        <p>
          The platform will include:
          <ul>
            <li>User-friendly interfaces for clients and developers.</li>
            <li>Secure payment options like M-Pesa integration.</li>
            
            <li>A centralized service directory for easy access to local talent.</li>
            
          </ul>
        </p>
      </div>
    </div>

    <!-- FAQ Item 4 -->
    <div class="faq-item">
      <div class="faq-question">
        <span>Who can use this platform?</span>
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        <p>
          The platform is designed for:
          <ul>
            <li>Clients in Kenya seeking software development services.</li>
            <li>Local software developers looking for clients and projects.</li>
            <li>Businesses and individuals who prefer working with local talent.</li>
          </ul>
        </p>
      </div>
    </div>

    <!-- FAQ Item 5 -->
    <div class="faq-item">
      <div class="faq-question">
        <span>How will the platform ensure security and trust?</span>
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        <p>
          The platform will implement:
          <ul>
            
            <li>Secure payment gateways with encryption for safe transactions.</li>
            <li>Dispute resolution mechanisms to handle conflicts between clients and developers.</li>
          </ul>
        </p>
      </div>
    </div>

    <!-- FAQ Item 6 -->
    <div class="faq-item">
      <div class="faq-question">
        <span>What technologies will be used to develop the platform?</span>
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        <p>
          The platform will be developed using:
          <ul>
            <li>Frontend: HTML, CSS, JavaScript, and Bootstrap for responsive design.</li>
            <li>Backend: PHP and MySQL for server-side logic and database management.</li>
            <li>Paystack : a powerful payment gateway that enables businesses to accept payments online seamlessly. By integrating Paystack into your project, you can provide your users with a secure, fast, and reliable way to make payments using various methods, including credit/debit cards, bank transfers, and mobile money(M-Pesa)</li>
            <li>Version Control: Git and GitHub for collaboration and version tracking.</li>
          </ul>
        </p>
      </div>
    </div>

    <!-- FAQ Item 7 -->
    <div class="faq-item">
      <div class="faq-question">
        <span>How can I contribute to this project?</span>
        <span class="faq-toggle">+</span>
      </div>
      <div class="faq-answer">
        <p>
          You can contribute by:
          <ul>
            <li>Providing feedback during the pilot testing phase.</li>
            <li>Suggesting features or improvements based on your experience.</li>
            <li>Sharing the platform with potential users to increase adoption.</li>
          </ul>
        </p>
      </div>
    </div>
  </div><br><br>
  <button id="backButton">Go Back</button>

  <script>
    // JavaScript to toggle FAQ answers
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
      const question = item.querySelector('.faq-question');
      const toggle = item.querySelector('.faq-toggle');

      question.addEventListener('click', () => {
        item.classList.toggle('active');
      });
    });
  </script>


<script>document.getElementById("backButton").addEventListener("click", function() {
    history.back();
});</script>
</body>
</html>