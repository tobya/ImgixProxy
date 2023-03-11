## Imgix Proxy

Imgix is an amazing service that acts both as a cdn and also an image manipulation library.

Sometimes it is useful to have access to manipulated images after they have been through Imgix manipulation.

ImgixProxy works as a proxy and saves a copy and serves your images.  

eg

> mydomain.imgix.net/mypicture.jpg?h=500
> 
> proxy.mydomain.com/mypicture.jpg?h=500
> 

These will return the same file and you will have a copy of the file on your proxy server

It definitely does not do as good a job at setting the correct headers for caching etc, so I suggest you only use it for short periods of time when you want to save manipulated images.

set the following in your .env file

````
IMGIX_HOST=yoursubdomain.imgix.net
````

You can now access any images at  your source in yoursubdomain.imgix.net through the domain you run this proxy on.  Use the same parameters.

Images are saved in

> /storage/app/files
