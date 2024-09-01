import java.util.*;
class armstrong{
    public static void main(String args[]){
        Scanner s =new Scanner(System.in);
        int num,temp1,temp2,count,sum,r;
        System.out.println("Enter a number ");
        num=s.nextInt();
        temp1=temp2=num;
        if(num>=0 && num<10){
            System.out.println(num+" is an armstrong number");
            return;
        }
        count=0;
        //count of digits
        while(temp1>0){
            temp1=temp1/10;
            count++;
        }
        sum=0;

        while(temp2>0){
            r=temp2%10;
            for(int i=1;i<count;i++){
                r=r*r;
            }
            sum=sum+r;
            temp2=temp2/10;
        }
        if(sum==num){
            System.out.println(num+" is an armstrong number");
        }else{
            System.out.println(num+" is not an armstrong number");
        }
    }
}