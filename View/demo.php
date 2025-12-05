<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FAQ Section</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f7f9fc;
      margin: 0;
      padding: 0;
    }

    .faq-container {
      width: 80%;
      max-width: 800px;
      margin: 50px auto;
      background: #ffffff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .faq-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #222;
    }

    .faq-item {
      border-bottom: 1px solid #ddd;
      padding: 15px 0;
      cursor: pointer;
    }

    .faq-question {
      position: relative;
      padding-right: 20px;
      font-size: 18px;
      color: #0056d6;
      font-weight: 600;
    }

    .faq-question::after {
      content: '+';
      position: absolute;
      right: 0;
      font-size: 22px;
      transition: 0.4s;
    }

    .faq-item.active .faq-question::after {
      content: '-';
    }

    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.4s ease;
      font-size: 16px;
      color: #333;
      margin-top: 5px;
    }
  </style>
</head>

<body>

  <div class="faq-container">
    <h2>Frequently Asked Questions</h2>

    <div class="faq-item">
      <div class="faq-question">How do I create a new account?</div>
      <div class="faq-answer">
        To create an account, click on the **Sign Up** button and follow the steps. You only need your phone number and email ID.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">Is my payment information secure?</div>
      <div class="faq-answer">
        Yes. We use **bank-level encryption and secured servers** to ensure your information is always protected.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">How long do transactions take?</div>
      <div class="faq-answer">
        Most transactions are processed **instantly**. In rare cases, it may take up to 24 hours depending on bank servers.
      </div>
    </div>

    <div class="faq-item">
      <div class="faq-question">Are there any hidden fees?</div>
      <div class="faq-answer">
        No. We maintain a **transparent** fee structure. Standard transaction charges (if any) will be shown before payment.
      </div>
    </div>

  </div>

  <script>
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
      item.addEventListener('click', () => {
        item.classList.toggle('active');
        let answer = item.querySelector('.faq-answer');

        if (item.classList.contains('active')) {
          answer.style.maxHeight = answer.scrollHeight + "px";
        } else {
          answer.style.maxHeight = null;
        }
      });
    });
  </script>

</body>
</html>
