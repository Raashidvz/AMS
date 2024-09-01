import java.util.*;
public class insertAtSpecific {
    public static void main(String[] args) {
        Scanner s=new Scanner(System.in);
        System.out.println("Enter size of array");
        int n=s.nextInt();
        int a[]=new int[n+1];
        System.out.println("Enter "+n+" elements");
        for(int i=0;i<n;i++){
            a[i]=s.nextInt();
        }
        System.out.println("Enter element to be inserted");
        int x=s.nextInt();
        System.out.println("Enter position to be inserted");
        int p=s.nextInt();
        p--;
        if(p>n){
            System.out.println("Invalid position");
        }else{
            for(int i=(n-1);i>=p;i--){
                a[i+1]=a[i];
            }
            a[p]=x;
            System.out.println("Array after insertion");
            for(int i=0;i<(n+1);i++){
                System.out.print(a[i]+" ");
            }
        }
    }
}
