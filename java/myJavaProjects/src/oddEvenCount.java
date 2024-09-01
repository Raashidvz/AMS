import java.util.*;
public class oddEvenCount {
    public static void main(String[] args) {
        Scanner s=new Scanner(System.in);
        System.out.println("Enter limit");
        int size=s.nextInt();
        int a[]=new int[size];
        int evenCount,oddCount;
        evenCount=oddCount=0;
        System.out.println("Enter "+size+" elements");
        for(int i=0;i<size;i++){
            a[i]=s.nextInt();
            if(a[i]%2==0){
                evenCount++;
            }else{
                oddCount++;
            }
        }
        System.out.println(oddCount+" odd numbers and "+evenCount+" even numbers");
    }
}
