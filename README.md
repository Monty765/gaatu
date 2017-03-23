Gaatu Coding Interview 
======================

Assignment: Create a form for storing a list of products when the user scans a SKU, a unique 6 digit integer that represents a Product in our warehouse. The requirements are as follows:

1) Finish mapping the properties & relationships for entities Product & ProductList. The same Product can be in multiple different ProductList. And ProductList can contain many different products.

2) How you want to handle the front end is entirely up to you. We are mainly focused on back-end logic & flow. For example, you can create a form with just one SKU input field and create a submission request for every scan OR you can create a form with dynamic array of many SKU input fields.

3) When a user scans the SKU, it can sometimes be 10 digits long because at times the manufacturers include batch number at the end of the SKU. Be sure to always take the first 6 digits. For example: Product ID 1 has SKU 102436. If I scan 1024360024, it should still add Product ID 1 to the ProductList.

4) Use Symfony components when available!

5) When you are done, please create a public repository (Github or Bitbucket) where we can view your finished work. Please create a subdirectory inside the project root called screenshots and include some screenshots of the final results.
