{extends file='customer/page.tpl'}

{block name='page_title'}
  {l s='FoP Members' mod='fopmembers'}
{/block}

{block name='page_content'}
    {if $customers}
        <h1>FoP Members</h1>
        <ul>
            {foreach $customers as $customer}
                <li>
                    <h2>{$customer.company}</h2>
                    <p>
                    <strong>{$customer.lastname} {$customer.firstname}</strong>
                    {if $customer.website}
                        <br/><a href="{$customer.website}">{$customer.website}</a>
                    {/if}
                    </p>
                </li>
            {/foreach}
        </ul>
    {else}
        <p>Nothing here</p>
    {/if}
{/block}