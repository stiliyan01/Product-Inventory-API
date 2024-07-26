php artisan migrate --seed

JSON

{
"data": {
"attributes": {
"name": "name",
"description": "desc",
"price": 19.99,
"stock": 100
},
"relationships": {
"category": [
{
"type": "category",
"id": 1
}
]
}
}
}
