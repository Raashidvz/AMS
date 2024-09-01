import java.util.*;
public class smallestLargestArrayElement {
    public static void main(String[] args) {
        Scanner s=new Scanner(System.in);
        System.out.println("Enter limit ");
        int n=s.nextInt();
        int a[]=new int[n];
        System.out.println("Enter "+n+" elements");
        a[0]=s.nextInt();
        int small,large;
        small=large=a[0];
        for(int i=1;i<n;i++){
            a[i]=s.nextInt();
            if(a[i]>large){
                large=a[i];
            }
            if(a[i]<small){
                small=a[i];
            }
        }
        System.out.println(small+" is the smallest number and "+large+" is the largest number");
    }
}
