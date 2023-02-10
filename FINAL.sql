DROP TABLE IF EXISTS test2;
CREATE TABLE hospital_store(
    batch_number int(6) NOT NULL,
    injection_index int(3) NOT NULL,
    quantity int(6) NOT NULL,
    injection_name varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO hospital_store(batch_number,injection_index,quantity,injection_name) VALUES
(100110,100,002500,'Pizer'),
(200111,102,030000,'synofarm'),
(300110,103,001300,'hepatities A'),
(110210,106,004800,'covid shield');

CREATE TABLE injection_issuing_time_table(
    index_number int(3) NOT NULL,
    injection_name varchar(30) NOT NULL,
    issuing_date date NOT NULL,
    compatible_baby_age int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO injection_issuing_time_table(index_number,injection_name,issuing_date,compatible_baby_age) VALUES
(100,'Pizer','2022-01-10',01),
(102,'synofarm','2022-01-09',02),
(103,'hepatities  A','2022-01-11',01),
(106,'covid shield','2022-01-12',05);

CREATE TABLE doctor(
    do_id INT(10) PRIMARY KEY,
    do_name VARCHAR(30),
    phone_number INT(10),
    working_days VARCHAR(30),
    dopassword INT(10)   
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE nurse(
    nu_id INT(10) PRIMARY KEY,
    nuname VARCHAR(30),
    phone_number INT(10),
    working_days VARCHAR(30),
    nupassword INT(10)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE midwife(
    mw_id INT(10) PRIMARY KEY,
    mwname VARCHAR(30),
    phone_number INT(10),
    working_days VARCHAR(30),
    mwpassword INT(10)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE minorstaff(
    ms_id INT(10) PRIMARY KEY,
    msname VARCHAR(30),
    phone_number INT(10),
    working_days VARCHAR(30),
    mspassword INT(10)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE patient(
    pa_id INT(10) PRIMARY KEY,
    patient_phone_no INT(10),
    baby_name VARCHAR(30),
    pa_address VARCHAR(30),
    taken_injection VARCHAR(30),
    pa_injection_batch_no INT(10),
    baby_age INT(10),
    gender CHAR(1),
    pa_password INT(10)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE user_doctor(
  id INT NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE user_nurse(
  id INT NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE user_midewife(
  id INT NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE user_minorstaff(
  id INT NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE user_patient(
  id INT NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE user_admin(
  id INT NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE user_doctor
  ADD PRIMARY KEY (id);

ALTER TABLE user_nurse
  ADD PRIMARY KEY (id);

ALTER TABLE user_midewife
  ADD PRIMARY KEY (id);

ALTER TABLE user_minorstaff
  ADD PRIMARY KEY (id);

ALTER TABLE user_patient
  ADD PRIMARY KEY (id);

ALTER TABLE user_admin
  ADD PRIMARY KEY (id);

ALTER TABLE hospital_store
  ADD PRIMARY KEY (batch_number);

ALTER TABLE injection_issuing_time_table
  ADD PRIMARY KEY (index_number);

ALTER TABLE patient
  ADD PRIMARY KEY (pa_id);

ALTER TABLE doctor
  ADD PRIMARY KEY (do_id);

ALTER TABLE nurse
  ADD PRIMARY KEY (nu_id);

ALTER TABLE midewife
  ADD PRIMARY KEY (mw_id);

ALTER TABLE minorstaff
  ADD PRIMARY KEY (ms_id);