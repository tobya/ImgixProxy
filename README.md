## Imgix Proxy

Imgix is an amazing service that acts both as a cdn and also an image manipulation library.

Sometimes it is useful to have access to manipulated images after they have been through Imgix manipulation.

ImgixProxy works as a proxy and saves a copy and serves all your images.  

eg

> mydomain.imgix.net/mypicture.jpg?h=500
> 
> proxy.mydomain.com/mypicture.jpg?h=500
> 

These will return the same file and you will have a copy of the file on your proxy server
