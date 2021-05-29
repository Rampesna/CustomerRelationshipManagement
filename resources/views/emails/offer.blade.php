<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script>
        var xml, xsl, result;

        function xmlDocumentLoad(fileName) {
            var xhttp;
            xhttp = new XMLHttpRequest();
            xhttp.open('GET', fileName, false);
            xhttp.send('');
            return xhttp.responseXML;
        }

        function showResult() {
            xml = xmlDocumentLoad("{{ asset('test.xml') }}");
            xsl = xmlDocumentLoad("{{ asset('test.xslt') }}");

            if (window.ActiveXObject) {
                result = xml.transformNode(xsl);
                document.querySelector("#result").innerHTML = result;
            } else if (document.implementation && document.implementation.createDocument) {
                xsltP = new XSLTProcessor();
                xsltP.importStylesheet(xsl);
                resultDocument = xsltP.transformToFragment(xml, document);
                document.querySelector("#result").appendChild(resultDocument);
            }
        }


    </script>

</head>
<body onload="showResult()">

<div id="result">

</div>
</body>
</html>
