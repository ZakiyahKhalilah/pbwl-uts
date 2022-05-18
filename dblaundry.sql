--
-- Database: `dblaundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_laundry`
--

CREATE TABLE tb_laundry (
  laundry_id int(11) NOT NULL,
  laundry_jenis varchar(100) NOT NULL,
  PRIMARY KEY (laundry_id)
  );
  
-- --------------------------------------------------------

INSERT INTO `tb_laundry` (`laundry_id`, `laundry_jenis`) VALUES
  (001, 'Cuci Lipat Gosok'),
  (002, 'Cuci Lipat'),
  (003, 'Cuci'),
  (004, 'Gosok');


--
-- Struktur dari tabel `tb_baju`
--

CREATE TABLE tb_baju (
  baju_id int(11) NOT NULL,
  baju_id_laundry int(11) NOT NULL,
  baju_berat varchar(100) NOT NULL,
  PRIMARY KEY (baju_id),
  FOREIGN KEY(baju_id_laundry) REFERENCES tb_laundry(laundry_id)
  );

-- --------------------------------------------------------

INSERT INTO `tb_baju` (`baju_id`, `baju_id_laundry`, `baju_berat`) VALUES
  (01, '001', '7 kg'),
  (02, '003', '15 kg'),
  (03, '001', '9 kg'),
  (04, '002', '10 kg'),
  (05, '001', '7 kg');

--
-- Struktur dari tabel `tb_member`
--
 
CREATE TABLE tb_member (
  member_id int(11) NOT NULL,
  member_name VARCHAR(100) NOT NULL,
  member_id_baju int(11) NOT NULL,
  time DECIMAL(4,0),
  PRIMARY KEY (member_id),
  FOREIGN KEY(member_id_baju) REFERENCES tb_baju(baju_id)
  );

-- --------------------------------------------------------

INSERT INTO `tb_member` (`member_id`, `member_name`, `member_id_baju`, `time`) VALUES
  (1, 'Zakiyah Khalilah Daulay', '01', '15-05-2021'),
  (2, 'Khairil Anwar Daulay', '02', '16-05-2021'),
  (3, 'Mardhiyatul Hasanah Daulay', '03', '17-05-2021'),
  (4, 'M. Syiaruddin Daulay', '04', '18-05-2021'),
  (5, 'Nur Sayyidah Daulay', '05', '19-05-2021');

--
-- Struktur dari tabel `tb_transaksi`
-- 

CREATE TABLE tb_transaksi (
  transaksi_id int(11) NOT NULL,
  transaksi_id_member int(11) NOT NULL,
  transaksi_total TIMESTAMP NOT NULL,
  PRIMARY KEY (transaksi_id),
  FOREIGN KEY(transaksi_id_member) REFERENCES tb_member(member_id)
  );
  
-- --------------------------------------------------------
  
INSERT INTO `tb_transaksi` (`transaksi_id`, `transaksi_id_member`, `transaksi_total`) VALUES
  (0001, '1', '40000'),
  (0002, '2', '75000'),
  (0003, '3', '60000'),
  (0004, '4', '60000'),
  (0005, '5', '40000');
  
  INSERT INTO `tb_played` (`ply_id`, `ply_id_track`, `ply_played`) VALUES 
  ('1202', '0002', current_timestamp),
  ('1203', '0003', current_timestamp);
  
  
  
