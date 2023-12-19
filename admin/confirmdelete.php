<!DOCTYPE html>
<html>
<head>
  <title>Thông báo xoá</title>
  <style>
    .confirmation-container {
      width: 300px;
      padding: 20px;
      background-color: #f2f2f2;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin: 50px auto;
      text-align: center;
    }

    .confirmation-container h2 {
      margin-top: 0;
    }

    .confirmation-container button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .confirmation-container button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="confirmation-container">
    <h2>Bạn có chắc muốn xoá?</h2>
    <button id="delete-button">Xoá</button>
  </div>

  <script src="script.js"></script>
</body>
</html>
<script>
    document.getElementById("delete-button").addEventListener("click", function() {
  var confirmed = confirm("Bạn có chắc muốn xoá?");
  if (confirmed) {
    // Xử lý logic xoá tại đây
    alert("Đã xoá thành công!");
  } else {
    alert("Xoá bị hủy!");
  }
});
</script>