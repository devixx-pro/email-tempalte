<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Section</title>
    <link
        href="https://fonts.googleapis.com/css2?family=AR+One+Sans:wght@400..700&family=Chivo+Mono:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&family=Staatliches&family=Tinos:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: "Source Sans 3", sans-serif;
        }

        /* Top header with logo + address */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 33px;
            background: #D3FADE;
            padding-bottom: 30px;
        }

        .top-bar img {
            width: 152px;
        }

        .top-bar p {
            font-size: 12px;
            margin: 0;
            color: #333;
            padding-top: 15px;
        }

        /* Middle Box */
        .highlight-box {
            text-align: center;
            padding: 30px 20px;
            background: #D3FADE;
        }

        .highlight-box h1 {
            font-size: 70px;
            color: #1c7a5a;
            margin: 0;
        }

        .highlight-box .right-text {
            font-size: 35px;
            font-weight: bold;
            color: #000;
            font-family: "Staatliches", sans-serif;
        }

        .highlight-box .right-text span {
            color: #1c7a5a;
        }

        .note {
            margin-top: 20px;
            background: #CACBFF;
            color: #000;
            font-size: 15px;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid #000000;
            text-align: left;
        }

        .note strong {
            color: #1c7a5a;
        }

        /* Footer box */
        .footer {
            background: #1c7a5a;
            color: #fff;
            font-weight: bold;
            text-align: center;
            padding: 15px;
            font-size: 20px;
        }

        .footer span {
            color: #ffd700;
        }

        .main_content {
            width: 50%;
            margin: 0 auto;
            background: #fff;
        }

        .top-bar p {
            font-size: 13px;
            color: #000;
        }

        .top-bar span img {
            width: 7px;
        }

        .banner_section div {
            display: flex;
        }

        .banner_section div h1 {
            font-size: 129px;
            font-weight: 700;
            font-family: "Source Sans 3", sans-serif;
            color: #7BD198;
            text-shadow: 6px 2px 0px #000000;
        }

        .highlight-box .banner_section {
            width: 100%;
            max-width: 83%;
            margin: 0 auto;
            background: url(image/dots.png);
            padding: 40px;
            background-color: #fff;
            border: 1px solid #053e05;
            position: relative;
        }

        .highlight-box .banner_section::before {
            content: "";
            background: #053e05;
            height: 10px;
            width: 100%;
            display: block;
            position: absolute;
            left: 0;
            bottom: 0;
        }

        .highlight-box .banner_section::after {
            content: "";
            background: #053e05;
            height: 100%;
            width: 10px;
            display: block;
            position: absolute;
            right: 0;
            top: 0;
        }

        .hope p span {
            color: #053e05 !important;
            font-weight: 500;
        }

        .highlight-box .right-text span {
            color: #000;
            position: relative;
            z-index: 9;
        }

        .highlight-box .right-text span>span::before {
            content: "";
            background: #7bd198;
            height: 14px;
            width: 100%;
            position: absolute;
            bottom: 8px;
            z-index: -1;
        }

        .welcome .banner_section {
            background: #fff !important;
        }

        .welcome .banner_section h3 span {
            color: #006838;
        }

        .welcome h3 {
            font-size: 41px;
            margin: 0;
            font-family: "Staatliches", sans-serif;
        }

        .hope img {
            width: 100%;
        }

        .hope p {
            text-align: left;
        }

        .hope .banner_section {
            background: #fff;
            padding: 20px;
            max-width: 90%;
        }

        header {
            padding: 10px 0;
            background: #d3fade;
        }

        .banner_bg::before {
            content: "";
            background: url(image/sdafdsf.png);
            height: 738px;
            width: 471px;
            display: block;
            position: absolute;
            z-index: 1;
            left: -167px;
            top: -14px;
        }

        .banner_bg::after {
            content: "";
            background: url(image/fasdfadsf.png);
            height: 738px;
            width: 471px;
            display: block;
            position: absolute;
            z-index: 1;
            right: -167px;
            top: 20%;
        }

        .highlight-box .banner_section {
            position: relative;
            z-index: 2;
        }

        .banner_bg {
            position: relative;
            overflow: hidden;
            z-index: 2;
        }

        .agents {
            padding: 30px 0;
            margin: 0px auto;
            background: #fff;
            max-width: 91%;
        }

        .agents h2 {
            text-align: center;
            font-size: 44px;
            font-weight: bold;
            margin-bottom: 44px;
            line-height: 1;
            font-family: "Staatliches", sans-serif;
            margin-top: 10px;
        }

        .agents h2 span {
            color: #0a9447;
            /* Green highlight */
        }

        .agents .content {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        .agents .content img {
            width: 100%;
        }

        .agents .text {
            flex: 1 1 500px;
        }

        .agents .text h3 {
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 0;
            border-bottom: 1px solid #000;
            padding-bottom: 20px;
            font-family: "Staatliches", sans-serif;
            letter-spacing: 1.5px;
        }

        .agents .text p {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 12px;
            font-weight: 500;
        }

        .agents .text strong {
            font-weight: bold;
        }

        .agents .text .highlight {
            color: #0a9447;
            font-weight: bold;
        }

        .agentss {
            position: relative;
        }

        .agentss {
            position: relative;
            width: 48%;
        }

        .agentss::before {
            content: "";
            background: #006838;
            height: 10px;
            width: 100%;
            display: block;
            position: absolute;
            left: 0;
            bottom: 0;
        }

        .agentss::after {
            content: "";
            background: #006838;
            height: 100%;
            width: 10px;
            display: block;
            position: absolute;
            right: 0;
            top: 0;
        }

        .box-agents {
            border-top: 2px solid #006838;
            border-bottom: 2px solid #006838;
        }

        .americans .highlight-box h1 {
            line-height: 1;
            margin: 0;
            font-size: 109px;
            font-weight: 700;
            font-family: "Source Sans 3", sans-serif;
            color: #7BD198;
            text-shadow: 6px 2px 0px #000000;
            text-align: left;
        }

        .americans .highlight-box h2::before {
            content: "";
            position: absolute;
            bottom: -8px;
            height: 3px;
            width: 135px;
            background: #000;
        }

        .americans .highlight-box h2 {
            text-align: left;
            font-family: "Staatliches", sans-serif;
            font-size: 35px;
            line-height: 1.2;
            position: relative;
        }

        .americans .highlight-box h2 span {
            color: #006838;
            font-family: "AR One Sans", sans-serif;

        }

        .americans .highlight-box img {
            width: 100px;
            height: auto;
            object-fit: contain;
        }




        .agents-thrive {
            max-width: 92%;
            margin: 0px auto;
            padding: 30px;
            background: #d3fade;
            border-bottom: 2px solid #053e05;
        }

        .agents-thrive h2 {
            font-size: 39px;
            font-weight: bold;
            margin-bottom: 20px;
            font-family: "Staatliches", sans-serif;
            text-align: left;
        }

        .agents-thrive h2 span {
            color: #1e9a66;
            /* Emerald Green */
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background: #B9FFD5;
            border: 2px solid #111613;
            padding: 20px;
            flex: 1 1 calc(50% - 20px);
            position: relative;
        }

        .card img {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 68px;
            height: 68px;
            object-fit: contain;
        }

        .card.full div {
            width: 59%;
        }

        .card h3 {
            background: #d7c9f5;
            display: inline-block;
            padding: 5px 8px;
            font-size: 20px;
            margin-bottom: 15px;
            text-transform: uppercase;
            font-family: "Staatliches", sans-serif;
            width: fit-content;
            margin-top: 0;
            font-weight: 500;
            line-height: 1;
        }

        .card p {
            font-size: 15px;
            line-height: 1.6;
            font-weight: 500;
        }

        .card strong {
            font-weight: bold;
        }

        /* Full width card */
        .card.full {
            flex: 1 1 100%;
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .card.full img {
            position: static;
            width: 214px;
            height: auto;
            flex-shrink: 0;
        }

        .flex-card {
            display: flex;
            gap: 10px;
        }

        .glimps .banner_section {
            padding: 20px;
            width: 68%;
            background: #B9FFD5 !important;
        }

        .example-box p span {
            background: #e2ceee;
            color: #7d12b9;
        }

        .human-capital {
            max-width: 88%;
            margin: 0 auto 40px;
            border: 2px solid #000000;
            padding: 20px;
            background: #B9FFD5;
        }

        .human-capital h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
            display: inline-block;
            padding-bottom: 3px;
            font-family: "Staatliches", sans-serif;
            position: relative;
            display: flex;
            align-items: end;
            line-height: 0.7;
            gap: 5px;
        }

        .human-capital h2::after {
            content: "";
            background: #006838;
            height: 2px;
            width: 200px;
            display: block;
            margin-left: 10px;

        }

        .human-capital h2 span {
            color: #1e9a66;
            /* emerald green */
        }

        .human-capital p {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 12px;
            font-weight: 500;
        }




        .example-box strong {
            color: #111;
        }

        .highlight {
            color: #000;
            /* red highlight */
            font-weight: bold;
        }

        /* Three Questions Section */
        .three-questions {
            max-width: 88%;
            margin: 0 auto;
            border: 2px solid #006838;
            border-radius: 0 64px 0px 0;
            padding: 20px;
            background: #fff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .three-questions::after {
            content: "";
            background: #006838;
            height: 100%;
            width: 10px;
            display: block;
            position: absolute;
            right: 0;
            top: 0;
        }

        .three-questions::before {
            content: "";
            background: #006838;
            height: 10px;
            width: 100%;
            display: block;
            position: absolute;
            left: 0;
            bottom: 0;
        }


        .three-questions h2 span {
            color: #1e9a66;
        }

        .question {
            display: flex;
            align-items: center;
            background: #e9f0ff;
            /* light blue */
            margin-bottom: 12px;
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
        }

        .question-number {
            background: #1F283D;
            color: #fff;
            font-weight: bold;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0px;
            margin-right: 12px;
            font-size: 22px;
            position: relative;
        }


        .question-number::after {
            content: "";
            background: #000;
            height: 100%;
            width: 3px;
            display: block;
            position: absolute;
            right: 0;
            top: 0;
        }

        .question-number::before {
            content: "";
            background: #000;
            height: 3px;
            width: 100%;
            display: block;
            position: absolute;
            left: 0;
            bottom: 0;
        }



        .glimps {
            background: #fff !important;
        }

        .example-box {
            background: #83E2C4;
            padding: 15px;
            margin: 15px 0;
            font-size: 15px;
            line-height: 1.6;
            position: relative;
            font-family: "Chivo Mono", monospace;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .example-box ::before {
            content: "";
            background: #053e05;
            height: 4px;
            width: 100%;
            display: block;
            position: absolute;
            left: 0;
            bottom: 0;
        }



        .example-box ::after {
            content: "";
            background: #053e05;
            height: 100%;
            width: 4px;
            display: block;
            position: absolute;
            right: 0;
            top: 0;
        }

        .three-questions h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
            display: inline-block;
            padding-bottom: 3px;
            font-family: "Staatliches", sans-serif;
            position: relative;
            display: flex;
            align-items: end;
            line-height: 0.7;
            gap: 5px;
        }

        .three-questions h2::after {
            content: "";
            background: #006838;
            height: 2px;
            width: 200px;
            display: block;
            margin-left: 10px;
        }

        .question p::before {
            content: "";
            background: #000;
            height: 29px;
            width: 2px;
            display: block;
            position: relative;
            left: -15px;
            top: 0;
        }

        .question p {
            font-size: 16px;
            font-weight: 500;
            position: relative;
            padding-left: 20px;
            line-height: 1.5;
            display: flex;
            align-items: center;
            width: 80%;
        }


        .leaders {
            max-width: 100%;
            border-top: 2px solid #000;
            border-radius: 0;
            padding: 30px;
            background: #d3fade;
            margin: 40px auto;
            margin-bottom: 0;
        }

        .leaders h2 {
            font-weight: bold;
            text-align: left;
            font-size: 58px;
            margin: 0;
            font-family: "Staatliches", sans-serif;
            margin-bottom: 35px !important;
            position: relative;
            padding: 0 15px;
            overflow: hidden;
            padding-top: 35px;
        }

        .leaders h2::after {
            content: "";
            background: #006838;
            height: 2px;
            width: 390px;
            display: block;
            margin-left: 10px;
            position: absolute;
            left: 200px;
            bottom: 19px;
        }


        .leader-text h3 {
            font-size: 21px;
            font-weight: 500;
            display: inline-block;
            padding: 8px 10px;
            border: 1.5px solid #085b2d;
            margin: 0 0 8px;
            border-radius: 0px;
            font-family: "AR One Sans", sans-serif;
            position: relative;
        }

        .leader-text h3::before {
            content: "";
            background: #006838;
            height: 4px;
            width: 100%;
            display: block;
            position: absolute;
            left: 0;
            bottom: 0;
        }


        .leader-text h3::after {
            content: "";
            background: #053e05;
            height: 100%;
            width: 4px;
            display: block;
            position: absolute;
            right: 0;
            top: 0;
        }

        .leaders h2 span {
            color: #006838;
            /* green highlight */
        }

        .leader-card {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 15px;
            margin-bottom: 20px;
        }

        .leaders>div {
            background: #fff;
            border: 2px solid #006838;
        }

        .leader-text {
            width: 75% !important;
        }

        .leader-text p em::before {
            content: "";
            background: #b9ffd5;
            height: 10px;
            width: 100%;
            display: block;
            position: absolute;
            bottom: 2px;
            z-index: -1;
        }

        .leader-text p em {
            font-style: inherit !important;
            font-weight: 500;
            font-size: 19px;
            position: relative;
            z-index: 2;
        }

        .leader-text p {
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
            font-weight: 500;
        }

        .leader-image {
            position: relative;
        }

        .leader-image::before {
            content: "";
            background: #006838;
            height: 4px;
            width: 100%;
            display: block;
            position: absolute;
            left: 0;
            bottom: 3px;
        }


        .leader-image::after {
            content: "";
            background: #006838;
            height: 97%;
            width: 6px;
            display: block;
            position: absolute;
            right: 0;
            top: 1px;
        }

        .leader-image {
            width: 156px;
            margin-left: 20px;
        }

        .leader-image img {
            width: 100%;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .testimonial-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #d6c7f5;
            padding: 25px;
            border: 2px solid #000;
            box-shadow: 6px 6px 0px #000;
            max-width: 83%;
            margin: 0 auto;
        }

        .testimonial {
            width: 100%;
            padding: 0;
            background: #d3fade;
            padding-bottom: 30px;
        }

        .testimonial-content {
            max-width: 70%;
        }

        .testimonial-title {
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 15px;
            font-family: "Staatliches", sans-serif;
            letter-spacing: 2px;
            border-bottom: 2px solid;
            width: fit-content;
        }

        .testimonial-text {
            font-style: italic;
            font-size: 15px;
            line-height: 1.5;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .testimonial-author {
            font-weight: bold;
            font-size: 14px;
            text-align: right;
            padding-right: 15px;
        }

        .testimonial-author span {
            font-weight: normal;
            font-style: italic;
        }

        .testimonial-image img {
            width: 160px;
            height: auto;
            border: 2px solid #000;
            box-shadow: 6px 6px 0px #000;
        }



        .emerald-section {
            background: #16243c;
            color: #fff;
            padding: 50px 30px;
            border-radius: 0 0px 0px 65px;
            max-width: 100%;
            margin: 0px auto;
            position: relative;
        }

        .emerald-section h2 {
            font-size: 42px;
            font-weight: 900;
            margin-bottom: 15px;
            font-family: "Staatliches", sans-serif;
            letter-spacing: 2px;
            border-bottom: 2px solid;
            width: auto;
            padding-bottom: 20px;
            margin-top: 0;
        }

        .emerald-section h2 .highlight {
            color: #2ecc71;
            /* Emerald Green */
        }



        .emerald-section p {
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .emerald-section ul {
            list-style: none;
            padding: 0;
        }

        .emerald-section ul li {
            margin-bottom: 15px;
            font-size: 16px;
            padding-left: 10px;
            position: relative;
        }

        .emerald-section ul li::before {
            content: "";
            background: url(image/sdafadsfsd.png);
            width: 7px;
            height: 7px;
            display: inline-block;
            background-repeat: no-repeat;
            position: relative;
            left: -6px;
        }

        .emerald-section strong {
            color: #fff;
        }

        .diffrence {
            padding: 20px 0;
            background: #d3fade;
        }

        .join-ilite {
            overflow: hidden;
        }

        .join-ilite {
            padding: 25px 0;
            background: #d3fade;
            position: relative;
            z-index: 2;
            padding-bottom: 43px;
        }

        .elite-section {
            background: url(image/dots.png);
            border: 3px solid #006838;
            max-width: 79%;
            margin: 0px auto;
            padding: 40px 25px;
            text-align: center;
            box-shadow: 12px 12px 0px #006838;
            background-color: #fff;
            margin-left: 37px;
        }

        .elite-section h1 {
            font-size: 47px;
            font-weight: bold;
            font-family: "Tinos", serif;
            margin-top: 0 !important;
            border-bottom: 1px solid #000;
            width: fit-content;
            margin: 0 auto;
            padding-bottom: 20px;
            margin-bottom: 29px;
            line-height: 1;
        }

        .elite-section h1 .highlight {
            color: #2ecc71;
            /* Emerald Green */
        }

        .elite-section p.subheading {
            font-size: 18px;
            font-weight: bold;
            color: #0b3d2c;
            margin-bottom: 30px;
            position: relative;
            width: fit-content;
            margin: 0 auto;
            z-index: 2;
        }

        .elite-section p.subheading::before {
            content: "";
            background: #7adea4;
            position: absolute;
            bottom: 5px;
            width: 100%;
            height: 7px;
            display: block;
            z-index: -1;
        }

        .elite-buttons {
            margin: 25px 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 22px;
            margin: 10px;
            font-size: 14px;
            font-weight: bold;
            border: 2px solid #000;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
        }

        .join-ilite::before {
            content: "";
            background: url(image/asdfasdf.png);
            width: 314px;
            height: 471px;
            display: block;
            position: absolute;
            z-index: -1;
            left: -39px;
            top: -46px;
        }


        .join-ilite::after {
            content: "";
            background: url(image/sdfgsdfgds.png);
            width: 294px;
            height: 471px;
            display: block;
            position: absolute;
            z-index: -1;
            right: -39px;
            bottom: -46px;
            background-position: top center;
        }

        .btn-green {
            background: #D3FADE;
            color: #000;
            border: 2px solid #000;
            box-shadow: 2px 2px 0px #000;
            font-family: "AR One Sans", sans-serif;
            width: 81%;
        }

        .btn-green:hover {
            background: #27ae60;
            color: #fff;
        }

        .btn-outline {
            background: #fff;
            color: #000;
            border: 2px solid #000;
            box-shadow: 2px 2px 0px #000;
            font-family: "AR One Sans", sans-serif;
            width: 81%;
            margin: 10px auto;
        }

        .btn-outline:hover {
            background: #000;
            color: #fff;
        }

        .elite-image {
            margin: 20px auto;
            max-width: 100%;
            border: 0px solid #000;
            padding: 0px;
            border-radius: 0px;
            box-shadow: 5px 5px 0px #000;
            width: 51%;
        }

        .elite-footer {
            margin-top: 0px;
            padding: 10px;
            background: #dcdaf5;
            display: inline-block;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        .flex-colum {
            display: flex;
            align-items: center;
        }

        footer {
            background: #B9FFD5;
            padding: 35px 36px;
            position: relative;
            z-index: 2;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer h2 span {
            color: #1e9a66;
        }

        footer h2 {
            font-size: 33px;
            font-family: "Tinos", serif;
            margin: 0;
        }

        .details li {
            margin-top: 20px;
            font-size: 20px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        footer::before {
            content: "";
            background: url(image/kahskdjf.png);
            width: 267px;
            height: 207px;
            display: block;
            position: absolute;
            bottom: 16%;
            left: 42%;
            z-index: -1;
        }

        .colum-flex h3 span {
            color: #1e9a66;
        }

        .details li span {
            width: 30px;
            height: 30px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 3px 3px 0px #006838;
        }

        .colum-flex ul li img {
            width: 28px;
        }

        .colum-flex h3 {
            font-size: 33px;
            font-family: "Tinos", serif;
            padding: 10px 0;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .colum-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .colum-flex ul {
            display: flex;
            gap: 10px;
        }

        .copyrigt b {
            margin: 0;
            font-size: 18px;
            color: #fff;
            font-weight: 500;
            text-decoration: underline;
            display: flex;
            justify-content: center;
            gap: 5px;
            padding-bottom: 5px !important;
        }

        .copyrigt p {
            margin: 0;
            font-size: 16px;
            color: #fff;
            padding-bottom: 10px;
        }

        .copyrigt {
            padding: 20px;
            text-align: center;
            background: url(image/sdfhjkadsfhaksjdf.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #1F283D;
        }

        footer hr {
            width: 175px;
            margin: 0;
            margin-top: 35px;
            background: #111613;
        }

        .details li b::before {
            content: "";
            background: #b6b8b7;
            height: 7px;
            position: absolute;
            display: block;
            bottom: 8px;
            width: 100%;
            z-index: -1;
        }


        footer::after {
            content: "";
            background: url(image/asfasdfhkasdjf.png);
            height: 50px;
            width: 100%;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0.5;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .details li b {
            position: relative;
            z-index: 2;
        }



        @media only screen and (max-width: 767px) {

            .main_content {
                width: 100%;
            }

            .top-bar {
                display: grid;
                justify-content: center;
                padding: 0px 15px;
                z-index: 9;
            }

            .top-bar img {
                width: 152px;
                margin: 0 auto;
                position: relative;
                z-index: 2;
            }

            .top-bar p {
                z-index: 2;
                position: relative;
            }

            .banner_section div {
                display: grid;
            }

            .highlight-box .banner_section {
                width: 100%;
                max-width: 87%;
                margin: 0 auto;
                padding: 40px 15px;
                position: relative;
                padding-right: 25px;
            }

            .banner_section div h1 {
                line-height: 0.5;
            }

            .welcome h3 {
                font-size: 29px;
            }

            .welcome .banner_section {
                padding: 20px 20px;
            }

            .hope .banner_section {
                background: #fff;
                padding: 20px;
                max-width: 78%;
            }

            .hope {
                padding: 35px 0;
            }

            .agents h2 {
                font-size: 35px;
            }

            .agents .content {
                display: grid;
            }

            .agentss {
                position: relative;
                width: 100%;
            }

            .americans .highlight-box h1 {
                font-size: 70px;

            }

            .americans .highlight-box h2 {
                font-size: 30px;
            }

            .flex-card {
                display: grid;
                gap: 10px;
            }

            .card.full {
                flex: 1 1 100%;
                display: grid;
                align-items: flex-start;
                gap: 20px;
            }

            .card.full div {
                width: 100%;

            }

            .agents-thrive {
                max-width: 92%;
                padding: 4px 19px;
                padding-bottom: 35px;
            }

            .human-capital h2 {
                font-size: 28px;
                display: grid;
                align-items: end;
                line-height: 1;
                gap: 5px;
            }

            .human-capital h2::after {
                content: "";
                width: 137px;
                position: absolute;
                right: 0;
                bottom: 8px;
            }

            .three-questions h2 {
                display: grid;
                line-height: 1;
                gap: 5px;
            }

            .leaders h2 {
                font-size: 31px;
            }

            .three-questions h2::after {
                content: "";
                width: 122px;
                position: absolute;
                right: 0;
                bottom: 10px;
            }

            .human-capital p {
                font-size: 13px;
            }

            .leader-card {
                display: grid;
                gap: 20px;
            }

            .leaders h2::after {
                content: "";
                width: 146px;
                left: 127px;
                bottom: 11px;
            }

            .testimonial-box {
                display: grid;
                padding: 25px 15px;
                max-width: 80%;
                margin: 0 auto;
                margin-left: 15px;
            }

            .testimonial-image img {
                width: 97%;
                height: auto;
                border: 2px solid #000;
                box-shadow: 6px 6px 0px #000;
                margin: 0 auto;
                margin-bottom: 25px;
            }

            .flex-colum {
                display: grid;
                align-items: center;
            }

            .btn-green {
                width: 96%;
                margin-left: 3px;
            }

            .colum-flex {
                display: grid;
                align-items: center;
                justify-content: space-between;
            }

            footer::before {
                content: "";
                background: url(image/kahskdjf.png);
                width: 196px;
                height: 138px;
                display: block;
                position: absolute;
                bottom: 4%;
                left: 42%;
                z-index: -1;
                background-size: contain;
                background-repeat: no-repeat;
            }

            .details li {
                margin-top: 20px;
                font-size: 16px;
                display: flex;
                gap: 10px;
                align-items: center;
            }

            footer {
                padding: 35px 15px;
                z-index: 2;
            }

            .btn-outline {
                width: 97%;
                margin-left: 0px;
            }

            .elite-image {
                margin: 20px auto;
                max-width: 100%;
                border: 0px solid #000;
                padding: 0px;
                border-radius: 0px;
                box-shadow: 5px 5px 0px #000;
                width: 95%;
                display: flex;
                margin-left: 5px;
            }

            .elite-section {
                max-width: 79%;
                padding: 40px 15px;
                margin-left: 15px;
            }

            .testimonial-box>div:first-child {
                order: 2;
            }

            .testimonial-content {
                max-width: 100%;
            }

            .leaders {
                padding: 30px 15px;
            }

            .leader-card>div:first-child {
                order: 2;
            }

            .leader-image {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="main_content">


        <div class="banner_bg">
            <header>
                <!-- Header -->
                <div class="top-bar">
                    <img src="image/emrald-logo.jpeg" alt="Logo">
                    <p> <span><img src="image/location.png" alt=""></span> 300 Airborne Parkway, Suite 210,
                        Cheektowaga, NY 14225
                    </p>
                </div>
            </header>
            <!-- Middle highlight -->
            <div class="highlight-box">
                <div class="banner_section">
                    <div>
                        <h1>8%</h1>
                        <p class="right-text">
                            ONLY 8% OF LICENSED AGENTS ARE ACTUALLY <span><span>ACTIVE</span> AND
                                <span>THRIVING</span></span>
                        </p>
                    </div>


                    <p class="note">
                        <strong>92%</strong> of agents quit <br> because they lack mentorship, modern systems, and
                        proper support.
                    </p>
                </div>
            </div>

            <!-- welcome -->
            <div class="highlight-box welcome">
                <div class="banner_section">
                    <h3> WELCOME TO YOUR <span>FUTURE</span></h3>
                </div>
            </div>


            <!-- i hope section -->
            <div class="highlight-box hope">
                <div class="banner_section">
                    <img src="image/hope.png" alt="">
                    <p>
                        <b>I hope this message finds you ready for change.</b><br>
                        At <span>Emerald Wealth Services,</span> we help agents move past setbacks and finally thrive.
                        We’re more
                        than an agency we’re a movement built on proven mentorship, innovative strategies, and the
                        belief that your
                        success is non-negotiable.
                        In a recession-proof industry like insurance, you can achieve financial independence, build
                        generational
                        wealth, and secure families’ futures. With our proven blueprint, countless agents have scaled
                        from
                        struggling to succeeding and you can too.
                    </p>
                </div>
            </div>
        </div>

        <div class="box-agents">
            <div class="agents">
                <h2>WHY MOST AGENTS FAIL <br> ( AND HOW YOU CAN <span>SUCCEED</span> )</h2>

                <div class="content">
                    <div class="agentss">
                        <img src="image/fasdfasfasdf.png" alt="Agent">
                    </div>

                    <div class="text">
                        <h3>THE REALITY</h3>
                        <p>Over <strong>1 million</strong> agents are licensed in the U.S., yet only 8% are active and
                            thriving.
                            <strong>The difference?</strong> The right mentorship, proven systems, and a clear roadmap.
                        </p>
                        <p>At <span class="highlight">Emerald Wealth Services</span>, we provide exactly that support,
                            tools, and
                            guidance from leaders who’ve built six-figure businesses. We don’t just aim to be the 8% -
                            we are the 8%,
                            and with us, you can be too. Your breakthrough starts here. Together, we’ll turn potential
                            into lasting
                            success.</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="americans">
            <div class="highlight-box">
                <div class="banner_section">
                    <h1>100M+</h1>

                    <div>
                        <div>
                            <h2><span>100M+</span>
                                Americans lack adequate life insurance coverage.</h2>
                        </div>
                        <div>
                            <img src="image/asdfsfsdfasd.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <section class="agents-thrive">
            <h2>WHY <span>EMERALD</span> AGENTS THRIVE</h2>

            <div class="cards">
                <div class="flex-card">
                    <!-- Card 1 -->
                    <div class="card">
                        <h3>SIX-FIGURE INCOME <br> POTENTIAL</h3>
                        <p>Your <strong>income</strong> tied to effort, not salary.
                            <strong>Six figures</strong> built through discipline, mentorship, and the right agency
                            support.
                        </p>
                        <img src="image/fasdfljadsflj.png" alt="Income Icon">
                    </div>

                    <!-- Card 2 -->
                    <div class="card">
                        <h3>BECOME A WEALTH <br>PROTECTOR</h3>
                        <p><strong>Life insurance</strong> is the greatest <strong>wealth</strong> transfer asset.
                            Every policy protects <strong>families</strong> and preserves legacies.
                            Recession Proof Career</p>
                        <img src="image/adkaslfjasdklf.png" alt="Wealth Icon">
                    </div>
                </div>

                <!-- Card 3 (Full Width) -->
                <div class="card full">
                    <div>
                        <h3>RECESSION PROOF CAREER</h3>
                        <p>The insurance industry remains strong in any economy because <strong>families</strong> always
                            need protection.
                            Unlike other fields that collapse in downturns, life insurance is essential not optional.
                            This gives you a <strong>stable career</strong> path with lasting income security.</p>
                    </div>
                    <img src="image/flasdkfjadsklfj.png" alt="Career Icon">
                </div>
            </div>
        </section>


        <!-- welcome -->
        <div class="highlight-box welcome glimps">
            <div class="banner_section">
                <h3>Here Is the Glimpse Into<br> <span>Emerald’s</span> Private Training</h3>
            </div>
        </div>


        <!-- Protecting Your Human Capital -->
        <section class="human-capital">
            <h2>PROTECTING YOUR <span>HUMAN CAPITAL</span></h2>
            <p>Human capital is the present value of your <strong>future earnings.</strong></p>

            <div class="example-box">
                <p><strong>Example:</strong><br>
                    If your annual income is $100,000, multiply that by 20.<br>
                    $100,000 × 20 = <span class="highlight">$2,000,000</span> — this is the “need” amount.</p>

                <img src="image/asdasdasd.png" alt="">
            </div>

            <p>At a 5% payout rate, <span class="highlight">$2,000,000</span> will generate $100,000 annually, fully
                replacing your income and maintaining your family’s standard of living.</p>
        </section>

        <!-- Close with Three Questions -->
        <section class="three-questions">
            <h2>CLOSE WITH <span>THREE QUESTIONS</span></h2>

            <div class="question">
                <div class="question-number">1</div>
                <p>If you don’t come home tomorrow what would happen to your family?</p>
            </div>

            <div class="question">
                <div class="question-number">2</div>
                <p>How does that make you feel?</p>
            </div>

            <div class="question">
                <div class="question-number">3</div>
                <p>How much money can you comfortably set aside on a monthly basis to solve this problem?</p>
            </div>
        </section>



        <section class="leaders">
            <div>
                <h2>LEARN FROM PROVEN <span>LEADERS</span></h2>

                <!-- Leader 1 -->
                <div class="leader-card">
                    <div class="leader-text">
                        <h3>Kizzy Bowen</h3>
                        <p><em>Six-Figure Producer & Daily Mentor</em><br>
                            Trains agents on daily habits for finding freedom, body language, and growth-driven
                            routines.</p>
                    </div>
                    <div class="leader-image">
                        <img src="image/kizzy.png" alt="Kizzy Bowen">
                    </div>
                </div>

                <!-- Leader 2 -->
                <div class="leader-card">
                    <div class="leader-text">
                        <h3>Mahad Mohamed</h3>
                        <p><em>Six-Figure Producer & Growth Mentor</em><br>
                            Builds agents’ success by combining clear goals, leadership skills, and practical sales
                            training.</p>
                    </div>
                    <div class="leader-image">
                        <img src="image/mahad.png" alt="Mahad Mohamed">
                    </div>
                </div>

                <!-- Leader 3 -->
                <div class="leader-card">
                    <div class="leader-text">
                        <h3>Cody Askins</h3>
                        <p><em>8% Nation Founder & Mentor</em><br>
                            Influences 140,000+ agents, helping them achieve six-figure incomes within 12 months.</p>
                    </div>
                    <div class="leader-image">
                        <img src="image/kody.png" alt="Cody Askins">
                    </div>
                </div>

                <!-- Leader 4 -->
                <div class="leader-card">
                    <div class="leader-text">
                        <h3>Dr. Sanjay Tolani</h3>
                        <p><em>Global Mentor & Author</em><br>
                            20+ years elevating careers through mindset, financial literacy, and proven sales
                            strategies.</p>
                    </div>
                    <div class="leader-image">
                        <img src="image/sanajy.png" alt="Dr. Sanjay Tolani">
                    </div>
                </div>
            </div>

        </section>


        <div class="testimonial">
            <div class="testimonial-box">
                <!-- Left content -->
                <div class="testimonial-content">
                    <div class="testimonial-title">TESTIMONIAL</div>
                    <div class="testimonial-text">
                        “I went from no sales experience to <b><i>six figures</i></b> in 1st year.
                        <b>Kizzy’s</b> daily consistency and the weekly training sessions completely
                        transformed my approach. I’m no longer surviving, <br>
                        <b><i>I’m thriving!</i></b>”
                    </div>
                    <div class="testimonial-author">
                        — Emily, Ontario <span>(Six-Figure Producer)</span>
                    </div>
                </div>

                <!-- Right image -->
                <div class="testimonial-image">
                    <img src="image/asdkfhasdkfh.png" alt="Emily">
                </div>
            </div>
        </div>


        <section class="diffrence">
            <div class="emerald-section">
                <h2>THE <span class="highlight">EMERALD</span> DIFFERENCE</h2>
                <p>While other agencies leave you alone, we provide:</p>
                <ul>
                    <li><strong>Daily Support:</strong> Never face challenges alone.</li>
                    <li><strong>Weekly “Kick Me Anything” Training:</strong> Live practice on real producers.</li>
                    <li><strong>Modern Digital Tools:</strong> Zoom presentations, CRMs, designs, and systems.</li>
                    <li><strong>Emotional Selling Techniques:</strong> Connect with families, not just numbers.</li>
                    <li><strong>Proven Mentorship:</strong> Learn from leaders who have built six-figures.</li>
                </ul>
            </div>
        </section>


        <section class="join-ilite">
            <div class="elite-section">
                <h1>Join the <span class="highlight">Elite</span></h1>
                <p class="subheading">Your success isn’t a question of IF — it’s a question of WHEN</p>

                <div class="flex-colum">
                    <img src="image/sdjflkjsdlf.png " alt="Person" class="elite-image">

                    <div>
                        <div class="elite-buttons">
                            <button class="btn btn-green">APPLY TO JOIN EMERALD NOW</button>
                            <button class="btn btn-outline">START YOUR APPLICATION</button>
                        </div>

                        <div class="elite-footer">
                            The families who need you can’t afford to wait.
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer>
            <div>
                <h2>Ready To Transform Your <span>Career?</span></h2>
                <ul class="details">
                    <li> <span><img src="image/aasdfasdf.png" alt=""></span> <b>Website:</b>
                        www.emeraldwealthservices.com</li>
                    <li> <span><img src="image/afasdfsd.png" alt=""></span> <b>Email:</b>
                        info@emeraldwealthservices.com</li>
                    <li> <span><img src="image/asdjasldjas.png" alt=""></span> <b> Phone:</b> +1 (800)
                        515-6707</li>
                </ul>
                <hr>
            </div>
            <div class="colum-flex">
                <div>
                    <h3>Stay <span>Connected</span></h3>
                    <ul>
                        <li><img src="image/dasdask.png" alt=""> </li>
                        <li> <img src="image/dasdlasjl.png" alt=""> </li>
                        <li><img src="image/jfaslfjal.png" alt=""> </li>
                        <li><img src="image/asjdlasjd.png" alt=""></li>
                    </ul>
                </div>
                <div>
                    <img src="image/adasjdl.png" alt="">
                </div>
            </div>


        </footer>
        <div class="copyrigt">
            <p>You’re receiving this because you expressed interest in career and income opportunities.</p>
            <b>Unsubscribe <span> | </span> Update Preferences</b>
        </div>

    </div>
</body>

</html>
