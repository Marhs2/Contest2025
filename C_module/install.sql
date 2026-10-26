-- GIFTS:Mall C모듈 데이터베이스 설치 스크립트
-- 사용법: phpMyAdmin에서 가져오기 하거나  mysql -uroot --default-character-set=utf8mb4 < install.sql
SET NAMES utf8mb4;
DROP DATABASE IF EXISTS cmodule;
CREATE DATABASE cmodule CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cmodule;

-- 회원 (비밀번호는 SHA256(salt + 비밀번호) 해시로 저장)
CREATE TABLE user (
  idx INT AUTO_INCREMENT PRIMARY KEY,
  id VARCHAR(50) NOT NULL UNIQUE,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(100) NOT NULL,
  salt CHAR(64) NOT NULL,
  psw CHAR(64) NOT NULL,
  isAd TINYINT NOT NULL DEFAULT 0,
  regDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 판매상품 (price: 원래 가격, sale: 0 없음 / 1 만원할인 / 2 10%할인 / 3 30%할인)
CREATE TABLE item (
  idx INT AUTO_INCREMENT PRIMARY KEY,
  cate VARCHAR(20) NOT NULL,
  title VARCHAR(100) NOT NULL,
  des TEXT NOT NULL,
  price INT NOT NULL,
  sale TINYINT NOT NULL DEFAULT 0,
  img VARCHAR(255) NOT NULL,
  regDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 장바구니 (회원별, 로그아웃 후에도 유지)
CREATE TABLE cart (
  idx INT AUTO_INCREMENT PRIMARY KEY,
  userId VARCHAR(50) NOT NULL,
  itemId INT NOT NULL,
  count INT NOT NULL DEFAULT 1,
  UNIQUE KEY user_item (userId, itemId)
);

-- 공지사항
CREATE TABLE notice (
  idx INT AUTO_INCREMENT PRIMARY KEY,
  type VARCHAR(10) NOT NULL,
  title VARCHAR(200) NOT NULL,
  date DATE NOT NULL
);

-- 관리자 계정 admin / 1111
INSERT INTO user (id, name, email, salt, psw, isAd) VALUES
('admin', '관리자', 'admin@giftsmall.kr',
 'a3f1c9e7b25d4086a1f2e3d4c5b6a7980f1e2d3c4b5a69788796a5b4c3d2e1f0',
 SHA2(CONCAT('a3f1c9e7b25d4086a1f2e3d4c5b6a7980f1e2d3c4b5a69788796a5b4c3d2e1f0', '1111'), 256), 1);

-- 제공텍스트 A모듈 공지사항
INSERT INTO notice (type, title, date) VALUES
('이벤트', '24년 7월 <헬스+출석체크인> 이벤트 당첨자 공지', '2024-08-08'),
('이벤트', '7월 [기프트몰TV 보러갈래?] 이벤트 당첨자 발표', '2024-08-07'),
('일반', '[배송안내] 8/14(수)~8/15(목) 택배사 휴무 관련', '2024-08-06'),
('일반', '딘토 이벤트 조기 종료 안내', '2024-08-05'),
('일반', '하월곡점 폐점으로 인한 영업종료 안내', '2024-07-31'),
('일반', '양평점 리로케이션으로 인한 영업 중단 안내', '2024-07-31');

-- 판매상품.xlsx 기준 상품 (세일 표시 상품은 할인방법 코드로 저장)
INSERT INTO item (cate, title, des, price, sale, img, regDate) VALUES
('건강식품','이뮨 멀티비타민&미네랄','국내 판매 1위 멀티비타민 이뮨 14일분에 이중제형 + 남/녀 맞춤설계 포뮬러를 적용한 신제품',75000,1,'./asaset/A-Module/images/건강식품/1.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 0 MINUTE)),
('건강식품','센트룸','생기 넘치는 일상을 위한 센트룸 우먼 더블업. 비타민 B군 8종 함량 2배, 23가지 비타민과 미네랄, 한국인 여성 맞춤 영양 설계',27000,0,'./asaset/A-Module/images/건강식품/2.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 1 MINUTE)),
('건강식품','닥터브라이언','달콤한 청포도맛 구미로 맛있게 비타민 C와 D를 충전하세요. 활기찬 하루와 튼튼한 뼈 건강을 맛있게 충전하는 부드러운 젤리 타입',2000,0,'./asaset/A-Module/images/건강식품/3.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 2 MINUTE)),
('건강식품','액티브 멀티포맨','미국판매 1위 내셔널 건강기능식품 브랜드. 남성 건강을 생각하는 22가지 주요 비타민&미네랄',30000,0,'./asaset/A-Module/images/건강식품/4.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 3 MINUTE)),
('건강식품','네이처메이드B12','여성 건강을 생각하는 23가지 주요 비타민&미네랄, 한국인 1일 영양 권장량을 고려한 철분, 엽산이 강화된 여성종합비타민',30000,0,'./asaset/A-Module/images/건강식품/5.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 4 MINUTE)),
('디지털','PANTONE PD충전 보조배터리','230g의 가벼운 무게로 휴대성 극대화, 3way 빌트인 케이블 채용, 10,000mAh의 대용량 배터리팩 내장',24400,0,'./asaset/A-Module/images/디지털/1.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 5 MINUTE)),
('디지털','Bowie D05 무선 블루투스 5.3 헤드셋','현실같은 3D사운드 스테이지 제공, 70시간의 오디오 재생시간, 2시간으로 완전 충전',36900,0,'./asaset/A-Module/images/디지털/2.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 6 MINUTE)),
('디지털','독거미 F99 기계식 키보드','최고의 퍼포먼스를 경험하게 해주는 키보드, 안정적인 무선 전송, 저소음 디자인, 일체형 실리콘 패드 디자인으로 소음 최소화, 프리미엄 PCB기판 채용으로 안정적이고 편안한 타건감 제공',70750,0,'./asaset/A-Module/images/디지털/3.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 7 MINUTE)),
('디지털','파이널마우스 스타라이트12 페가수스 미디엄','최첨단 펌웨어를 갖춘 업계 최고의 노르딕 RF 플랫폼 기반의 무선 기술 채용, 최대 20,000CPI 해상도를 갖춘 e스포츠 센서 채용',1254000,2,'./asaset/A-Module/images/디지털/4.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 8 MINUTE)),
('디지털','보이저5200 블루투스 이어폰','4개의 마이크 탑재, 6중 바람차단, 강력한 노이즈 캔슬링, 공간의 소음을 최대로 줄여 최적의 업무 환경을 경험할 수 있습니다.',146000,0,'./asaset/A-Module/images/디지털/5.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 9 MINUTE)),
('팬시','명품 자동 장우산','태풍에도 견디는 프리미엄 우드 장우산. 50개 이상 구매 시 손잡이 무료 각인 서비스 제공',31600,0,'./asaset/A-Module/images/팬시/1.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 10 MINUTE)),
('팬시','14K 윙블링 원터치 링 귀걸이(주문제작)','언제나 당신의 일상에 편안한 멋 평범한 순간마저 매력을 돋보이게 만들어 줄 14K Daily Collection. 본 상품은 주문 제작으로 배송은 약 7~10일 정도 소요됩니다(주말 및 공휴일 제외).',250000,0,'./asaset/A-Module/images/팬시/2.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 11 MINUTE)),
('팬시','14K 윙블링 메르시 목걸이(주문제작)','언제나 변함없고 고급스러운 전체 14K 골드로 제작되어 소장 가치뿐만 아니라 우아한 아름다움을 선사합니다. 본 상품은 주문 제작으로 배송은 약 7~10일 정도 소요됩니다(주말 및 공휴일 제외).',265000,0,'./asaset/A-Module/images/팬시/3.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 12 MINUTE)),
('팬시','게이밍 이어폰 VJJB NI','세계 1위 가성비 유선 이어폰. 듀얼 드라이버 기술로 완벽한 고품질 사운드와 교체가 가능한 분리형 커스텀 케이블',38900,1,'./asaset/A-Module/images/팬시/4.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 13 MINUTE)),
('팬시','인스탁스 미니 에보','당신이 보는 세상을 보여주세요. 가장 혁신적인 프리미엄 클래식 하이브리드 카메라, 묵직한 세련됨이 돋보이는 mini Evo의 클래식 디자인을 만나보세요.',320000,0,'./asaset/A-Module/images/팬시/5.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 14 MINUTE)),
('향수','에스쁘아 솔리드 퍼퓸 4.2g','새벽 달빛 아래 달큰한 체리가 어지럽게 흩어진 자리, 새하얀 자스민이 코끝을 스치고 자유롭게 남는 풍부한 머스크 향의 고체 향수',26000,0,'./asaset/A-Module/images/향수/1.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 15 MINUTE)),
('향수','호텔도슨 향수 오드퍼퓸 75ml','향긋하고 보드라운 마른 꽃과 나무 향 뒤로 낙엽이 타는 듯한 베티버 향이 퍼지는 스파이시 플로럴 향',153000,0,'./asaset/A-Module/images/향수/2.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 16 MINUTE)),
('향수','랑방 레 플레르 EDT 90ml','에너지 넘치고 빛나는 머스키 프루티 플로럴 향으로 부드러움과 반짝임의 완벽한 균형이 매력입니다.',64500,0,'./asaset/A-Module/images/향수/3.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 17 MINUTE)),
('향수','몽블랑 익스플로러 EDP 60ml','전 세계를 여행하는 탐험가의 향기. 에너제틱 베르가못에서 자연스러운 패출리로 이어지는 향의 여정(우디 레더리 아로마틱)',103000,1,'./asaset/A-Module/images/향수/4.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 18 MINUTE)),
('향수','캘빈클라인 One EDT 50ml','남녀 모두에게 어울리는 현대적이며, 라이트한 향의 캘빈클라인 CK one 오 드 뚜왈렛. 상쾌하고 신선한 시트러스 계열의 향으로 편안하고 캐주얼한 향수',58900,0,'./asaset/A-Module/images/향수/5.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 19 MINUTE)),
('헤어케어','어노브 딥 데미지 트리트먼트 EX 더블','부드러움에 집착하다! 어노브 집착 헤어팩! 단백질 3,000% UP으로 완성하는 극손상모 솔루션',29800,0,'./asaset/A-Module/images/헤어케어/1.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 20 MINUTE)),
('헤어케어','려 루트젠 여성맞춤 볼륨 탈모증상케어 샴퓨 353ml','근거있는 여성탈모 전문가 려 루트젠이 만든 촘촘탄탄 밀도탄력을 채우는 3D볼륨 탈모 샴푸. 부드럽고 향 좋은 약산성 비건 샴푸',21900,0,'./asaset/A-Module/images/헤어케어/2.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 21 MINUTE)),
('헤어케어','라보에이치 두피쿨링&노세범 샴푸 333ml','청량하게 리프레쉬-쿨링샴푸, 오래도록 뽀송뽀송-노세범샴푸, 두피장벽강화 특허기술-탈모증상 완화 기능성 샴푸',19800,0,'./asaset/A-Module/images/헤어케어/3.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 22 MINUTE)),
('헤어케어','모로칸오일 헤어트리트먼트 100ml','헤어케어, 컨디셔닝, 스타일링, 피니시까지 모두 가능한 단 하나의 헤어 오일 트리트먼트',52200,0,'./asaset/A-Module/images/헤어케어/4.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 23 MINUTE)),
('헤어케어','닥터포헤어 피토프레시 헤어쿨링 스프레이 150ml','열받아 예민해진 두피를 위한 즉각적인 두피 쿨링 솔루션. 온종일 느껴지는 상쾌함, 피토프레이 쿨링 스프레이',16000,2,'./asaset/A-Module/images/헤어케어/5.PNG',DATE_ADD('2024-08-01 09:00:00', INTERVAL 24 MINUTE));
