<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        async function request(){
            const url = 'http://localhost/cema/api/viewPatient/';
            const options = {
                method: 'POST',
                headers: {
                    authorization: '12345678:25ce09a7e89792db69077d5df0693cee',
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    id: "23456789"
                })
            };

            try {
                const response = await fetch(url, options);
                const data = await response.json();
                console.log(data);
            } catch (error) {
                console.error(error);
            }
        }

        request();
    </script>
</body>
</html>