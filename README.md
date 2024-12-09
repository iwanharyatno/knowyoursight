# Know Your Sight  
**AI Driven Retina Diagnostics: Early Detection of Cataract, Glaucoma, and Diabetic Retinopathy**  

Know Your Sight adalah platform berbasis AI yang dirancang untuk mendeteksi penyakit mata secara dini menggunakan analisis gambar retina. Dengan akurasi 92%, platform ini menawarkan solusi diagnostik yang andal, mudah diakses, dan terjangkau.  

## 📌 **Fitur Utama**  
1. **Deteksi Multi-Penyakit Mata:**  
   - Katarak  
   - Glaukoma  
   - Retinopati diabetik  
2. **Berbasis Web:**  
   - Mudah diakses kapan saja dan di mana saja melalui perangkat apa pun yang memiliki browser.  
3. **Pelacakan Riwayat:**  
   - Memungkinkan pengguna untuk memantau hasil prediksi dari waktu ke waktu.  
4. **Ekspor Laporan:**  
   - Hasil diagnosa dapat diunduh untuk referensi lebih lanjut.  

## 🧠 **Teknologi yang Digunakan**  
- **EfficientNet B0:** Model deep learning yang dioptimalkan untuk menganalisis gambar retina dengan akurasi tinggi.  
- **Backend:** Flask/Python (untuk pengolahan data dan integrasi model AI).  
- **Frontend:** HTML, CSS, JavaScript (untuk antarmuka pengguna).  
- **Database:** MongoDB (untuk penyimpanan data pengguna dan riwayat prediksi).  

## 🎯 **Tujuan Proyek**  
1. Membantu tenaga medis dalam mendeteksi penyakit mata lebih awal.  
2. Memberikan akses diagnosis yang lebih luas, terutama di daerah terpencil.  
3. Meningkatkan kesadaran masyarakat akan pentingnya kesehatan mata.  

## 🔬 **Dataset yang Digunakan**  
Kami menggunakan [dataset](https://www.kaggle.com/datasets/gunavenkatdoddi/eye-diseases-classification) retina dengan 4.217 gambar yang seimbang untuk melatih model deep learning. Dataset ini mencakup kategori normal, katarak, glaukoma, dan retinopati diabetik.

## 📊 **Evaluasi Model**
### Training & Validation Accuracy
![image](https://github.com/user-attachments/assets/0b3a3039-1971-45a0-9b5b-16899a71828f)

Validation accuracy sebesar 92,0% cukup baik, menunjukkan bahwa model ini dapat menggeneralisasi dengan cukup baik untuk data baru.

### Training & Validation Loss
![image](https://github.com/user-attachments/assets/b6568fee-c34b-443c-9653-f46606022160)

Validation Loss 0.34 mengindikasikan bahwa masih ada ruang untuk perbaikan.

### Confusion Matrix
| Class                 | Precision | Recall   | F1-Score | Support |
|-----------------------|-----------|----------|----------|---------|
| Cataract              | 0.9278    | 0.9184   | 0.9231   | 196     |
| Diabetic Retinopathy  | 0.9756    | 0.9600   | 0.9677   | 250     |
| Glaucoma              | 0.9074    | 0.8033   | 0.8522   | 183     |
| Normal                | 0.8182    | 0.9209   | 0.8665   | 215     |
| **Accuracy**          |           |          | **0.9064** | 844     |
| **Macro Avg**         | 0.9073    | 0.9006   | 0.9024   | 844     |
| **Weighted Avg**      | 0.9096    | 0.9064   | 0.9065   | 844     |

        
![image](https://github.com/user-attachments/assets/2805a957-4825-4ec8-a909-f422ee918277)

- Cataract: Presisi sebesar 0,93 dan recall sebesar 0,92. Hal ini menunjukkan bahwa model ini cukup baik dalam mengidentifikasi kasus katarak tanpa terlalu banyak false positive.
- Diabetic Retinopathy: Presisi yang sangat baik (0,98) dan recall (0,96). Hal ini menunjukkan bahwa model ini sangat efektif dalam mendeteksi retinopati diabetik.
- Glaucoma: Presisi (0,91) cukup baik, tetapi recall (0,80) menunjukkan beberapa kasus yang terlewatkan, yang bisa menjadi area untuk dikembangkan.
- Normal: Presisi 0,82 dan recall 0,92 menunjukkan bahwa meskipun model ini relatif baik dalam mengidentifikasi kasus-kasus normal, model ini mungkin memiliki beberapa false positive.

Akurasi keseluruhan 90,64% di semua kelas sangat solid, khususnya mengingat kompleksitas tugas klasifikasi pencitraan medis.

## 📈 Model Inference
![image](https://github.com/user-attachments/assets/03374528-0daf-48c5-90cb-4e5e739c26a3)

Hasil prediksi menunjukkan probabilitas keyakinan model terhadap setiap kategori diagnosis. Probabilitas ini mengindikasikan seberapa yakin model bahwa gambar retina yang dianalisis sesuai dengan kategori yang diprediksi. Probabilitas tinggi mendekati 100% menunjukkan keyakinan tinggi model terhadap prediksinya.

Prediksi probabilitas ini berbeda dari akurasi model. Akurasi mengacu pada evaluasi performa keseluruhan model dalam mengklasifikasikan data uji, sedangkan probabilitas adalah keyakinan model terhadap prediksi pada satu sampel data tertentu.

### Analisis Hasil Prediksi
1. Aktual: Glaukoma | Prediksi: Glaukoma (86.17%)
    <br>
    Model berhasil memprediksi kategori glaukoma dengan probabilitas keyakinan yang tinggi, yaitu 86.17%. Prediksi ini dianggap tepat karena kategori aktual dan prediksi cocok.

2. Aktual: Normal | Prediksi: Normal (77.13%)
    <br>
    Model memprediksi normal dengan probabilitas keyakinan 77.13%. Walaupun probabilitas ini lebih rendah dibandingkan kasus lain, prediksi tetap benar. Ini menunjukkan model cukup yakin, tetapi mungkin masih memiliki kebingungan antara normal dan kategori lainnya.

3. Aktual: Katarak | Prediksi: Katarak (100%)
    <br>
    Model menunjukkan keyakinan mutlak terhadap prediksi katarak. Probabilitas 100% adalah indikasi bahwa model sangat yakin, dengan pola-pola visual yang sangat khas dari katarak.

4. Aktual: Retinopati Diabetik | Prediksi: Retinopati Diabetik (76.23%)
    <br>
    Probabilitas 76.23% menunjukkan model cukup yakin terhadap prediksi retinopati diabetik. Namun, tingkat keyakinannya lebih rendah dibandingkan kasus lain, mungkin karena beberapa pola dalam gambar memiliki karakteristik yang mirip dengan kategori lain.

5. Aktual: Katarak | Prediksi: Katarak (99.74%)
    <br>
    Prediksi ini hampir mutlak dengan probabilitas 99.74%. Ini menunjukkan pola visual dari gambar retina dengan katarak sangat dikenali oleh model.

6. Aktual: Normal | Prediksi: Normal (95.92%)
    <br>
    Probabilitas tinggi (95.92%) menunjukkan keyakinan model terhadap prediksi normal. Prediksi ini akurat dan tingkat keyakinan model sangat baik.

Hasil prediksi ini menunjukkan bahwa model memiliki kemampuan yang optimal untuk mendeteksi berbagai kondisi mata dengan tingkat keyakinan yang baik. 
Probabilitas yang bervariasi memberikan gambaran tentang kepercayaan model terhadap prediksi, sekaligus mengindikasikan bagaimana model mengenali pola-pola unik dalam gambar retina. 
Meskipun terdapat beberapa prediksi dengan probabilitas lebih rendah, model tetap berhasil mengidentifikasi kategori dengan tepat, yang menunjukkan ketangguhan dan potensi besar dalam penerapan di lapangan. Dengan pengembangan dan pelatihan lebih lanjut, kami yakin bahwa platform ini dapat memberikan solusi diagnostik berbasis AI yang semakin akurat, konsisten, dan bermanfaat bagi banyak orang.


## 📞 **Kontak Tim**
**Jimly Assidqi Hardiansyah - Frontend Developer**
<br>
Email: jimlyasidqi692@gmail.com
<br>
Github: https://github.com/Jimly23
<br>
Linkedin: https://www.linkedin.com/in/jimlyassidqihardiansyah/

**Iwan Haryatno - Backend Developer**
<br>
Email: iwnharry61@gmail.com
<br>
Github: https://github.com/iwanharyatno
<br>
Linkedin: https://www.linkedin.com/in/iwanharyatno/

**Muhammad Abdiel Al Hafiz - Machine Learning Developer**
<br>
Email: hafd324@gmail.com
<br>
Github: https://github.com/dlzcods
<br>
Linkedin: https://www.linkedin.com/in/muhammad-abdiel-al-hafiz/


