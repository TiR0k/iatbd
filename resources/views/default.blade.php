<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/main.js" defer></script>
    <title>@yield("title")</title>
</head>


<body>
<header class="websiteHeader">
    <section class="headerLogo">
        <h1>PassenOpJeDier.nl</h1>
    </section>
    <section class="headerLinks">
        <ul class="u-list-style-none">
            <li><a href="/" class="u-list-style-none headerLinks__link">Home</a></li>
            <li><a href="/baasjes" class="u-list-style-none headerLinks__link">Baasjes in de buurt</a></li>
            <li><a href="/dieren/" class="u-list-style-none headerLinks__link">Alle dieren</a></li>
            <li><a href="/dashboard" class="u-list-style-none headerLinks__link">Mijn account</a></li>
        </ul>
    </section>
</header>
    @yield("content")
</body>
</html>
