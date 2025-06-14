<style>
    #second-section {
        display: none;
    }
  .hero_area {
    background: url('images/gambarkedai1.png') no-repeat;
    background-size: cover;
    background-position: center;
    min-height: 80vh;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .h2-custom {
    color: #b42e8b;
  }

  .h3-custom {
    font-weight: bold; text-decoration: underline; text-transform: uppercase;
  }

  .detail-box {
    background: rgba(15, 15, 15, 0.7);
    padding: 50px 40px;
    border-radius: 20px;
    color: #fff;
    text-align: center;
    max-width:80%;
    width: 80%;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.3);
  }

  .detail-box h1 {
    font-size: 35px;
    font-weight: 800;
    margin-bottom: 20px;
  }

  .detail-box p {
    font-size: 20px;
    /* margin-bottom: 30px; */
    line-height: 1.8;
  }

  /* Divider yang lebih minimalis */
  .divider {
    height: 0;
    margin: 30px 0;
    border: none;
    background: transparent;
  }

  /* Mengganti divider dengan garis halus dan lebih bersih */
  .divider::before {
    content: '';
    display: block;
    width: 85%;
    height: 3px;
    background: linear-gradient(to right, rgba(125, 10, 87, 0.995), rgb(235, 12, 153));
    margin: 0 auto;
  }

  .btn-box {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }

  .btn1,
  .btn2 {
    background: #72ca4f;
    color: #fff;
    padding: 15px 30px;
    border-radius: 30px;
    margin: 10px;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 18px;
    text-decoration: none;
  }

  .btn2 {
    background: #fff;
    color: #000;
  }

  .btn1:hover,
  .btn2:hover {
    transform: scale(1.05);
    transition: 0.3s ease-in-out;
  }

  .search-bar-container {
    margin-top: 30px;
  }

  .search-bar-container form {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 20px;
  }

  .search-bar-container input[type="text"] {
    width: 70%;
    padding: 15px;
    font-size: 18px;
    border: 1px solid #ccc;
    border-radius: 30px 0 0 30px;
    outline: none;
  }

  .search-bar-container button {
    padding: 15px 30px;
    font-size: 18px;
    border: none;
    background-color: #2faee0;
    color: #fff;
    cursor: pointer;
    border-radius: 0 30px 30px 0;
  }

  .search-bar-container button:hover {
    background-color: #d0002b;
  }

  .testimoni-section {
    padding: 80px 20px;
    background: linear-gradient(to right, rgba(255, 255, 255, 0.7), rgba(200, 230, 255, 0.7));
    text-align: center;
  }

  .testimoni-section h2 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 40px;
    color: #b42e8b;
  }

  .swiper {
    width: 100%;
    max-width: 900px;
    padding-top: 20px;
    padding-bottom: 50px;
  }

  .swiper-slide {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
    text-align: center;
  }

  .swiper-slide img {
    width: 700px;
    height: 500px;
    border-radius: 0;
    margin-bottom: 20px;
    object-fit: cover;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  .testimoni-name {
    font-weight: bold;
    margin-top: 10px;
    color: #333;
  }

  .testimoni-text {
    font-style: italic;
    font-size: 1rem;
    color: #666;
    margin-top: 10px;
  }

  /* --- Tambahan untuk Order Check Section --- */

  .order-check-section {
    background: #f0f8ff;
    padding: 80px 20px;
    text-align: center;
    border-radius: 15px;
    max-width: 600px;
    margin: 40px auto;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .order-check-section h2 {
    font-size: 2.5rem;
    margin-bottom: 15px;
    color: #333;
  }

  .order-check-section p {
    font-size: 1.1rem;
    margin-bottom: 30px;
    color: #555;
  }

  .order-check-form {
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  .order-check-form input[type="text"] {
    padding: 12px 20px;
    font-size: 1rem;
    border: 2px solid #ccc;
    border-radius: 8px;
    width: 70%;
    max-width: 400px;
    transition: border-color 0.3s ease;
  }

  .order-check-form input[type="text"]:focus {
    border-color: #b42e8b;
    outline: none;
  }

  .order-check-form button {
    background-color: #b42e8b;
    color: white;
    border: none;
    padding: 12px 25px;
    font-size: 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .order-check-form button:hover {
    background-color: #8a2167;
  }

  /* Responsive tweaks */
    @media (max-width: 768px) {
        .detail-box {
        padding: 30px 20px;
        max-width: 100%;
        }

        .detail-box h1 {
        font-size: 40px;
        }

        .detail-box p {
        font-size: 16px;
        }

        .btn-box {
        flex-direction: column;
        }

        .btn1, .btn2 {
        width: 80%;
        margin: 5px 0;
        font-size: 16px;
        }

        .search-bar-container input[type="text"] {
        width: 100%;
        border-radius: 30px 30px 0 0;
        }

        .search-bar-container button {
        width: 100%;
        border-radius: 0 0 30px 30px;
        }

        .search-bar-container form {
        flex-direction: column;
        }

        .order-check-form {
        flex-direction: column;
        }

        .order-check-form input[type="text"] {
        width: 100%;
        margin-bottom: 15px;
        }

        .order-check-form button {
        width: 100%;
        padding: 15px;
        }
    }
</style>
