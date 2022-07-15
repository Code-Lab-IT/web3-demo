# Quick start

1. Create wallet in MetaMask, do it in Chrome or Firefox of your computer.
2. If you are logged in then choose "Goerli Test Network"
3. Find some test coins, use Buy button 
4. Find charity.sol from this project and compile it. Use Remix online IDE for this https://remix.ethereum.org/
5. Deploy compiled contract to network. User Remix deploy module for it. Choose environment "Injected Web3", you should see your Metamask active account there. 
6. Open test.php and find ```contractAddress``` variable from there and replace it with contract address you just deployed.
7. Start docker container ```sh $ docker-compose up -d ``` and open  http://localhost/test.php
