# SaleAgent
custom module sale agent
I. Các bước pull code và chạy module
B1: Mở terminal, chạy : cd /var/www/html/tên project/app/code
B2: Chạy trong terminal: git clone https://github.com/Shiny-Heliolisk/SaleAgent
B3: chạy các lệnh trong terminal: bin/magento setup:upgrade && bin/magento setup:di:compile && bin/magento c:c && bin/magento s:s:d -f
B4: Hoàn thành.

II. Đề bài custom module
1.Introduction
  - Implement a system consisting of Sales Agent (SA).
  - SA is a customer as well. 
  - SA will be assigned with products, and receive commission when customer buy their product.
2.New Attributes
  - Customer: is_sales_agent (boolean) 
  - Product: sale_agent_id, commission_type (fixed/percent), commission_value 
3.Features
 a. Backend: </br>
 
    ○ Admin will be able to assign SA, commission type, value to each product. </br>
    ○ Commission report. Only do 1 out of 2 below:</br>
      ● Acc ording to Product, filterable by SKU with Ajax load. </br>
      ● According to SA, filterable by Email with Ajax load. </br>
      
 b. Frontend: </br>
 
    ○ When customer successfully place an order, SA will immediately receive commission. </br>
    ○ When a SA logged in to his account, he can preview (somew here in My Account) all product assigned to him 
    (you should display this with a table). </br>
      ● Product name, sku, url to the product</br>
      ● Commission type, commission value.. </br>
c. Global: </br>

    ○ SA's first name will be displayed as "Sales Agent: <firstname>" instead of "<firstnam e>" on all pages of the website
