<!DOCTYPE html>
<html lang="en">
<head>
  <title>Donation app</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
  <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
</head>
<body>

<table>
  <tr>
    <td>Contract owner address</td>
    <td id="owner"></td>
  </tr>
  <tr>
    <td>Contract balance</td>
    <td id="balance"></td>
  </tr>
  <tr>
    <td>Donate</td>
    <td><input type="number" id="amount" value="0.005"/>
      <button onclick="donateFunction()">Donate</button>
    </td>
  </tr>
  <tr>
    <td></td>
    <td>
      <button onclick="withdraw()">Withdraw</button>
    </td>
  </tr>
  <tr>
    <td></td>
    <td>
      <button onclick="destroyContract()">Destroy</button>
    </td>
  </tr>
</table>


<script>
  var contractAddress = '0x556c5184af843b580c939529ffbd575ebbabbe0e';

  //Enable Web3
  async function loadWeb3()
  {
    if (window.ethereum)
    {
      window.web3 = new Web3(window.ethereum);
    }
  }


  async function loadContract()
  {
    return await new window.web3.eth.Contract(
      [
        {
          "inputs": [],
          "name": "destroySmartContract",
          "outputs": [],
          "stateMutability": "nonpayable",
          "type": "function"
        },
        {
          "inputs": [],
          "name": "donate",
          "outputs": [],
          "stateMutability": "payable",
          "type": "function"
        },
        {
          "inputs": [],
          "stateMutability": "nonpayable",
          "type": "constructor"
        },
        {
          "inputs": [],
          "name": "withdraw",
          "outputs": [],
          "stateMutability": "nonpayable",
          "type": "function"
        },
        {
          "anonymous": false,
          "inputs": [
            {
              "indexed": false,
              "internalType": "uint256",
              "name": "value",
              "type": "uint256"
            }
          ],
          "name": "Withdraw",
          "type": "event"
        },
        {
          "stateMutability": "payable",
          "type": "receive"
        },
        {
          "inputs": [],
          "name": "owner",
          "outputs": [
            {
              "internalType": "address",
              "name": "",
              "type": "address"
            }
          ],
          "stateMutability": "view",
          "type": "function"
        }
      ]      , contractAddress);
  }

  // Read data from the contract
  async function getFunction()
  {
    ownerId = await window.contract.methods.owner().call();
    document.getElementById('owner').innerHTML = ownerId;

    balance = await window.web3.eth.getBalance(contractAddress);
    balance = balance / 1e18 + " ETH";
    document.getElementById('balance').innerHTML = balance;
  }

  // Load all functions
  async function load()
  {
    await loadWeb3(); //Enable Web3
    window.contract = await loadContract(); //Load Contract
    getFunction(); //Read data from the contract
  }

  load();

  async function destroyContract()
  {
    $account = await getAccount();
    set = await window.contract.methods.destroySmartContract().send(
      {
        from: $account
      }
    );
    console.log(set);
  }


  async function withdraw()
  {
    $account = await getAccount();
    set = await window.contract.methods.withdraw().send(
      {
        from: $account
      }
    );
    console.log(set);
  }

  async function donateFunction()
  {
    $eth = document.getElementById('amount').value;
    $wei = $eth * 1e18; // Change ETH to wei
    $account = await getAccount();
    set = await window.contract.methods.donate().send(
      {
        from: $account,
        value: $wei
      }
    );
  }

  async function getAccount()
  {
    const accounts = await ethereum.request({method: 'eth_requestAccounts'});
    return account = accounts[0];
    showAccount.innerHTML = account;
  }

</script>
</body>